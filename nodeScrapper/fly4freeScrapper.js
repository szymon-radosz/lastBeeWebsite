const requestPromise = require('request-promise');
const cheerio = require('cheerio');
const url = 'https://www.fly4free.com/flights/flight-deals/usa/';
const mysql = require('mysql');

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "lastBee"
});

var checkIfTableExists = "SHOW TABLES LIKE 'fly4free'";
console.log(checkIfTableExists);

con.query(checkIfTableExists, function (err, result) {
    if (err) throw err;

    console.log(result.length);

    if(result.length == 0){
        con.query("CREATE TABLE fly4free (id int NOT NULL AUTO_INCREMENT, title VARCHAR(255), description VARCHAR(255), page_url VARCHAR(255), img_url VARCHAR(255), PRIMARY KEY (id))", function (err, result) {
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

        let offertObject = {
            offertTitle: title,
            offertDescription: description,
            offertUrl: articleUrl,
            offertImageUrl: imageUrl
        };

        flyResults.push(offertObject);
    });

    flyResults.map(singleFlyResult => {
        var checkIfRecordExists = "SELECT * FROM fly4free WHERE page_url = '" + singleFlyResult.offertUrl + "' LIMIT 1";

        console.log(checkIfRecordExists);

        con.query(checkIfRecordExists, function (err, result) {
            if (err) throw err;

            console.log(result.length);

            if (result.length == 0){
                var sql = "INSERT INTO fly4free (title, description, page_url, img_url) VALUES ('" + singleFlyResult.offertTitle + "', '" + singleFlyResult.offertDescription + "', '" + singleFlyResult.offertUrl + "', '" + singleFlyResult.offertImageUrl + "')";
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

