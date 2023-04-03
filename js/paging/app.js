const express = require("express");
const app = express();
const path = require("path");
const axios = require("axios");
const port = 3000;

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

const idbase = 8;
const start = 0;
const setlimit = 2;
const token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Imd1c2VrYS5kZXZAZ21haWwuY29tIiwiaWF0IjoxNjgwMjQ2ODc5fQ.dueWFsCiZHrtMp0SxBSkq3xs-NjM8RcluSlFmcG7OI8";

const instance = axios.create({
  baseURL: 'https://app.apibuilderlab.com/api/',
  headers: {'x-access-token': token, 'Content-Type': 'application/json'}
});

app.get("/", (req, res)=>{

    instance.get('getreq/'+idbase+'/all' )
        .then(({data}) => {
            let result = data.data;
                    var rowdatalength = result.length;
                    var totalRecord = rowdatalength,
                        pageSize = 10,
                        pageCount = Math.ceil(rowdatalength / 10),
                        currentPage = 1,
                        rowsdataArrays = [],
                        recordlist = [];
                    var urlpaging = '/';

                    while (result.length) {
                        rowsdataArrays.push(result.splice(0, pageSize));
                    }
                    if (typeof req.query.page !== 'undefined') {
                        currentPage = +req.query.page;
                    }
                    recordlist = rowsdataArrays[+currentPage - 1];

                    res.render('page', {
                        title: 'Paging example API from apibuilderlab',
                        data: recordlist,
                        url: urlpaging,
                        pageSize: pageSize,
                        totalRecord: totalRecord,
                        pageCount: pageCount,
                        currentPage: currentPage
                    });

	    })
        .catch((e)=>{
            res.json({
                error: true,
                message: e.message
            })
        })
})

app.listen(port, ()=>{
    console.log("Server start on port "+port);
})