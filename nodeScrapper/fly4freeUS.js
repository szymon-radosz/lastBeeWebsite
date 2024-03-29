const requestPromise = require('request-promise');
const cheerio = require('cheerio');
const url = 'https://www.fly4free.com/flights/flight-deals/usa/';
const mysql = require('mysql');

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "root",
    database: "lastBee",
    socketPath: '/Applications/MAMP/tmp/mysql/mysql.sock'
});

var checkIfTableExists = "SHOW TABLES LIKE 'fly4freeUS'";
console.log(checkIfTableExists);

con.query(checkIfTableExists, function (err, result) {
    if (err) throw err;

    console.log(result.length);

    if(result.length == 0){
        con.query("CREATE TABLE fly4freeUS (id int NOT NULL AUTO_INCREMENT, title VARCHAR(255), description TEXT, page_url VARCHAR(255), img_url TEXT, brand VARCHAR(255), status INT, date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))", function (err, result) {
            if (err) throw err;
            console.log("Table created");
        });
    }else{
        console.log('table exists');
    }
});

requestPromise(url)
  .then(function(entireWebsiteHtml){
    const result = cheerio('.entries-sub > .entry', entireWebsiteHtml);

    const flyResults = [];

    result.map(i => {
        let title = cheerio('.entries > .entry > .entry__title', entireWebsiteHtml).eq(i).text();
        let description = cheerio('.entries > .entry > .entry__content > p > strong', entireWebsiteHtml).eq(i).text();
        let articleUrl = cheerio('.entries > .entry > .media-photo > a', entireWebsiteHtml)[i].attribs.href;
        let imageUrl = cheerio('.entries > .entry > .media-photo > a > img', entireWebsiteHtml)[i].attribs.src;
        let brand = "fly4freeUS"
        let status = 0;

        let offertObject = {
            offertTitle: title,
            offertDescription: description,
            offertUrl: articleUrl,
            offertImageUrl: `<img src="${imageUrl}" alt="fly4freeUS"/>`,
            brand: brand,
            status: status
        };

        flyResults.push(offertObject);
    });

    flyResults.map(singleFlyResult => {
        var checkIfRecordExists = "SELECT * FROM fly4freeUS WHERE page_url = '" + singleFlyResult.offertUrl + "' LIMIT 1";

        console.log(checkIfRecordExists);

        con.query(checkIfRecordExists, function (err, result) {
            if (err) throw err;

            console.log(result.length);

            if (result.length == 0){
                var sql = "INSERT INTO fly4freeUS (title, description, page_url, img_url, brand, status) VALUES ('" + singleFlyResult.offertTitle + "', '" + singleFlyResult.offertDescription + "', '" + singleFlyResult.offertUrl + "', '" + singleFlyResult.offertImageUrl + "', '" + singleFlyResult.brand + "', '" + singleFlyResult.status + "')";
                con.query(sql, function (err, result) {
                    if (err) throw err;
                    console.log("record added");
                });
            }
            else{
                console.log("record exists");
            }

        });
    });
  })
  .catch(function(err){
   console.log(err);
  });

