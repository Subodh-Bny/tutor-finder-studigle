const subjectSubBtn = document.getElementById("subject-submit");
const tutorsContainer = document.querySelector(".find-container");
subjectSubBtn.addEventListener("click", () => {
  const subjectChoosed = document.getElementById("subject").value;

  if (subjectChoosed != -1) {
    $.ajax({
      type: "POST",
      url: "./findBySubject.php",
      data: { subject: subjectChoosed },
      success: function (response) {
        tutorsContainer.innerHTML = response;
      },
    });
  } else {
    alert("SELECT VALID SUBJECT");
  }
});
