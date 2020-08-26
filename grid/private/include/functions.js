function setCheckbox(el) {
  el.setAttribute("value", el.checked)

}

//UPDATE VALUE ATTRIBUTE ON INPUT CHANGE
function updateInput(ish, id) {
  document.getElementById(id).setAttribute("value", ish);

}
//ADD A NEW TODO VOICE
function newToDo() {
  var html = document.querySelector(".todo-page-container").innerHTML;
  console.log(html);
  var idd = (Math.random()).toString().replace(".", "");
  var add = '<div><div class="ckcont"><input type="hidden" name="NewListCheck[]" value="0"><input checked="" class="ck" type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value"></div><div class="ckcont"><input   id=\'' +
    idd +
    '\' onkeypress=\'updateInput(this.value,"' + idd + '")\' class="VoiceTitle" type="text" name="NewListVoice[]" value="ToDo Title"></div></div>';
  document.querySelector(".todo-page-container").innerHTML = html + add;

}

//REMOVE TODO VOICE
function delCheck(elid, rowid) {
  document.querySelector("#" + elid).setAttribute("name", "DelRows[]")
  document.querySelector("#" + elid).setAttribute("value", rowid)
  document.getElementById("form1").submit();
}
//GENERIC FUNCITON FOR RELOAD
function reloadPage() {
  window.location.reload();

}

//FUNCTION USED FOR DELETE TODO IN HOME PAGE
function jsDelToDo(id, el, compl) {

  var r = confirm("ELIMINARE TODO " + id);
  if (r == true) {
    $.ajax({
      url: "../private/include/DelToDo.php?todo=" + id, //the page containing php script
      type: "POST", //request type
      success: function (result) {
        // el.parentElement.parentElement.outerHTML = ''
        reloadToDo(compl)
      }
    });
  } else {}
}

//FUNCTION USED FOR DELETE TODO IN TODO PAGE
function jsDelToDoFPage(id) {
  $.ajax({
    url: "../private/include/DelToDo.php?todo=" + id, //the page containing php script
    type: "POST", //request type
    success: function (result) {

      if (result == "SI") {
        location.href = "index.php";

      } else {
        alert('IMPOSSIBILE ELIMINARE TODO ' + id);
      }
    }
  });
}

//FUNCTION USED FOR REMOVE ROW FROM TODO USED IN TODO PAGE
function jsDelToDoRow(id) {
  $.ajax({
    url: "../private/include/DelToDoRow.php?todo=" + id, //the page containing php script
    type: "POST", //request type
    success: function (result) {

      if (result == "SI") {
        location.reload();

      } else {
        alert('IMPOSSIBILE ELIMINARE TODO ' + id);
      }
    }
  });
}

//FUNCTION THAT MARK A TODO AS COMPLETED
function jsComplToDo(id) {
  $.ajax({
    url: "../private/include/ComplToDo.php?todo=" + id, //the page containing php script
    type: "POST", //request type
    success: function (result) {

      reloadToDo(0)
    }
  });
}

function shwImg() {

  document.querySelectorAll(".modal_img")[0].style = "opacity:1;visibility:unset;";
}


function reloadToDo(compl) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../private/include/HTML_ListToDo.php?Compl=" + compl, true);
  xhr.onreadystatechange = function () {
    var state = xhr.readyState;
    if (state == 4) {
      var str = xhr.responseText;
      var target = document.querySelector("#grid");
      target.innerHTML = str;
      document.getElementById("modal-2").checked = false;


    }
  };

  xhr.send();


}

function CreateToDo() {
  var name = document.getElementById("NewTodo").value;
  var descr = document.getElementById("TodoDescr").value;
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../private/include/CreateToDo.php?Name=" + name + "&Descr=" + descr, true);
  xhr.onreadystatechange = function () {
    var state = xhr.readyState;
    if (state == 4) {
      var resp = xhr.responseText;
      reloadToDo(0);
    }
  };


  xhr.send();

}