
$(document).ready(function() {

  var rABS = true; // true: readAsBinaryString ; false: readAsArrayBuffer
function handleFile(e) {
  var files = e.target.files, f = files[0];
  var reader = new FileReader();
  reader.onload = function(e) {
    var data = e.target.result;
    if(!rABS) data = new Uint8Array(data);
    var workbook = XLSX.read(data, {type: rABS ? 'binary' : 'array'});

    /* DO SOMETHING WITH workbook HERE */
    var test = to_json(workbook);
    var arrayy = [];
    
    for(i = 0; i < test.Sheet1.length; i++) {
      arrayy.push(test.Sheet1[i]["ST DATE"]);
    }
    
    var counts = {};
    for (var j = 0; j < arrayy.length; j++) {
      counts[arrayy[j]] = 1 + (counts[arrayy[j]] || 0);
    }
    var test = Object.values(counts);
    console.log(test);
    console.log(test[0] + test[1]);
   
  };
  if(rABS) reader.readAsBinaryString(f); else reader.readAsArrayBuffer(f);
}

var excel = document.getElementById("excel");
excel.addEventListener('change', handleFile, false);

function to_json(workbook) {
  var result = {};
  workbook.SheetNames.forEach(function(sheetName) {
    var roa = XLS.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
    if(roa.length > 0){
      result[sheetName] = roa;
    }
  });
  return result;
}
  // page is now ready, initialize the calendar...

  $('#calendar').fullCalendar({
    // put your options and callbacks here
    weekends: false,
    height: 500,
  })
})