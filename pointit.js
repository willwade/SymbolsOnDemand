var newText = $("p").text().split(" ").join("</span> <span>");
newText = "<span>" + newText + "</span>";

$("p").html(newText)
    .hover(function() { 
      $(this).addClass("hilite"); 
    },
      function() { $(this).removeClass("hilite"); 
    })
  .end()
    .css({"font-style":"italic", "font-weight":"bolder"});
