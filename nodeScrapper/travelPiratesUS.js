const requestPromise = require('request-promise');
const cheerio = require('cheerio');
const url = 'https://www.travelpirates.com/flights';
const mysql = require('mysql');

const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "lastBee"
});

var checkIfTableExists = "SHOW TABLES LIKE 'travelPiratesUS'";
console.log(checkIfTableExists);

con.query(checkIfTableExists, function (err, result) {
    if (err) throw err;

    console.log(result.length);

    if(result.length == 0){
        con.query("CREATE TABLE travelPiratesUS (id int NOT NULL AUTO_INCREMENT, title VARCHAR(255), description TEXT, page_url VARCHAR(255), img_url TEXT, brand VARCHAR(255), status INT, date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (id))", function (err, result) {
            if (err) throw err;
            console.log("Table created");
        });
    }else{
        console.log('table exists');
    }
});

requestPromise(url)
  .then(function(entireWebsiteHtml){
    const result = cheerio('.post-list > .post-preview', entireWebsiteHtml);

    const flyResults = [];

    result.map(i => {
        let title = cheerio('.post-list > .post-preview > header > h2', entireWebsiteHtml).eq(i).text().replace('Show deal:', '').replace('Expired:', '').replace(/[#_/']/g, '').trim();
        let description = cheerio('.post-list > .post-preview > p', entireWebsiteHtml).eq(i).text().replace(/[#_/']/g, '').trim();
        let articleUrl = cheerio('.post-list > .post-preview > footer > a', entireWebsiteHtml)[i].attribs.href.trim();
        let imageUrl = cheerio('.post-list > .post-preview > .post-preview__image > noscript', entireWebsiteHtml).eq(i).text().trim();
        let brand = "travelPiratesUS";
        let status = 0;
        /*let imageFormatted = imageUrl;

        if(imageFormatted.slice(-2) != "/>"){
            imageFormatted += "/>";
        }*/

        //console.log(imageUrl);

        let offertObject = {
            offertTitle: title,
            offertDescription: description,
            offertUrl: articleUrl,
            offertImageUrl: imageUrl,
            brand: brand,
            status: status
        };

        flyResults.push(offertObject);
    });

    //console.log(flyResults);

   flyResults.map(singleFlyResult => {
        var checkIfRecordExists = "SELECT * FROM travelPiratesUS WHERE page_url = '" + singleFlyResult.offertUrl + "' LIMIT 1";

        console.log(checkIfRecordExists);

        con.query(checkIfRecordExists, function (err, result) {
           // if (err) throw err;
           if (err) console.log(err);

            console.log(result.length);

            if (result.length == 0){
                var sql = "INSERT INTO travelPiratesUS (title, description, page_url, img_url, brand, status) VALUES ('" + singleFlyResult.offertTitle + "', '" + singleFlyResult.offertDescription + "', '" + singleFlyResult.offertUrl + "', '" + singleFlyResult.offertImageUrl + "', '" + singleFlyResult.brand + "', '" + singleFlyResult.status + "')";
                con.query(sql, function (err, result) {
                    if (err) console.log(err);
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

