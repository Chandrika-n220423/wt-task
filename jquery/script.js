$(document).ready(function () {

  /* SELECTORS */
  $("#selectBtn").click(function () {
    $("p").css("color", "blue");
    $("#p1").css("font-weight", "bold");
    $(".cls:first").css("color", "red");
    $(".cls:last").css("color", "green");
    $("p:eq(2)").css("background", "pink");
    $("p:odd").css("font-size", "18px");
    $("p:not(.test)").css("border", "1px solid black");
  });

  /* ATTRIBUTES */
  $("#attrBtn").click(function () {
    $("#img").attr("src", "img2.jpg");
    $("#agree").prop("checked", true);
    alert($("#username").val());
    $("#username").removeAttr("value");
  });

  /* EVENTS */
  $("#clickBtn").click(() => alert("Clicked"));
  $("#clickBtn").dblclick(() => alert("Double Click"));
  $("#clickBtn").mouseenter(() => console.log("Mouse Enter"));
  $("#clickBtn").mouseleave(() => console.log("Mouse Leave"));

  $("#keyInput").keydown(() => console.log("Key Down"));
  $("#keyInput").keyup(() => console.log("Key Up"));

  $("#myForm").submit(function (e) {
    e.preventDefault();
    alert("Form Submitted");
  });

  /* STYLE */
  $("#styleBtn").click(function () {
    $("#styleText").css("color", "green");
    $("#styleText").toggleClass("highlight");
  });

  /* TRAVERSING */
  $("#travBtn").click(function () {
    $(".parent").children().first().css("color", "red");
    $(".parent").children().last().css("color", "blue");
    $(".parent").find("p:eq(1)").css("background", "yellow");
  });

  /* EFFECTS */
  $("#showBtn").click(() => $("#box").show());
  $("#hideBtn").click(() => $("#box").hide());
  $("#fadeBtn").click(() => $("#box").fadeToggle());
  $("#slideBtn").click(() => $("#box").slideToggle());

  $("#animateBtn").click(function () {
    $("#box")
      .animate({ left: "200px" }, 1000)
      .delay(500)
      .animate({ top: "100px", opacity: 0.5 }, 1000);
  });

  $("#stopBtn").click(function () {
    $("#box").stop();
  });

});