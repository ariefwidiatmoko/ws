    //Publish Later
    function hidePublish() {
      // Get the checkbox
      var checkBox = document.getElementById("hidePub");
      // Get the output text
      var info = document.getElementById("publishTime");

      // If the checkbox is checked, display the output text
      if (checkBox.checked == true){
        info.style.display = "none";
      } else {
        info.style.display = "block";
      }
    };

    /* Publish Time Datetimepicker*/
    $(function () {
      $('#datetimepicker12').datetimepicker({
          sideBySide: true
      });
    });
