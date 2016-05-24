function explode( delimiter, string ) {	// Split a string by string
    //
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: kenneth
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

    var emptyArray = { 0: '' };

    if ( arguments.length != 2
        || typeof arguments[0] == 'undefined'
        || typeof arguments[1] == 'undefined' )
    {
        return null;
    }

    if ( delimiter === ''
        || delimiter === false
        || delimiter === null )
    {
        return false;
    }

    if ( typeof delimiter == 'function'
        || typeof delimiter == 'object'
        || typeof string == 'function'
        || typeof string == 'object' )
    {
        return emptyArray;
    }

    if ( delimiter === true ) {
        delimiter = '1';
    }

    return string.toString().split ( delimiter.toString() );
}
$(document).ready(function () {
    var url = window.location.href;
    var arr = explode('/',url);
    var file = arr[arr.length -1];
    var path = "/statistics/graphics/" + file;
    var result = [];
    $.get(path, function (data,status) {
        result = JSON.parse(data);
        google.charts.load('current', {'packages':['line']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string','Day');
            data.addColumn('number', 'Upload');
            data.addColumn('number', 'Download');
            data.addRows(result);
            var options = {
                chart:{title: 'files statistics'},
                width:900,
                height:300
            };
            var chart = new google.charts.Line(document.getElementById('chart'));
            chart.draw(data, options);
        }
    });

});

