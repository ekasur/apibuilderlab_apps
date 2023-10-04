const express = require("express");
const app = express();
const path = require("path");
const axios = require("axios");
const bodyParser = require("body-parser");
const port = 3000;

app.use(bodyParser.urlencoded({ extended: false }))
app.use(bodyParser.json())

app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

const idbase = 1;
const token = "abl-yxwfoo1lna0g8ch";

const instance = axios.create({
  baseURL: 'https://app.apibuilderlab.com/api/',
  headers: {'x-access-token': token}
});

app.get("/", (req, res)=>{
    var page = req.query.page;
    var size = req.query.size;
    if ((typeof page=='undefined') || (page=='')){
        page = 1;
    }
    if ((typeof size=='undefined') || (size=='')){
        size = 20;
    }
    instance.get('getreq/'+idbase+'/paging/?page='+page+'&size='+size )
        .then(({data}) => {
            const recordlist = data.data;
            const totaldata = data.total;
            const totalpages = Math.ceil(totaldata / size);
            res.render('page', {
                title: 'Paging example API from apibuilderlab',
                data: recordlist,
                pageSize: size,
                totalRecord: totaldata,
                currentPage: page,
                totalpages: totalpages,
                currentapi: "https://app.apibuilderlab.com/api/getreq/"+idbase+"/paging/?page="+page+"&size="+size
            });
	    })
        .catch((e)=>{
            res.json({
                error: true,
                message: e.message
            })
        })
})


app.post("/search", (req, res)=>{
    var keyword = req.body.search;
    
    instance.post('searchreq/'+idbase, { "country_name_aka_111752597": keyword} )
        .then(({data}) => {

            const recordlist = data.data;
            const totaldata = data.total;
            res.render('searchpage', {
                title: 'Search example API from apibuilderlab',
                data: recordlist,
                totalRecord: totaldata,
                currentapi: "https://app.apibuilderlab.com/api/searchreq/"+idbase
            });
	    })
        .catch((e)=>{
            res.json({
                error: true,
                message: e.message
            })
        })
})

app.get("/details", (req, res)=>{
    var id = req.query.id;
    instance.get('getreq/'+idbase+'/details?id='+id )
        .then(({data}) => {
            const recordlist = data.data;
            const totaldata = data.total;
            res.render('details', {
                title: 'Details example API from apibuilderlab',
                data: recordlist,
                totalRecord: totaldata,
                currentapi: "https://app.apibuilderlab.com/api/getreq/"+idbase+"/details?id="+id
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