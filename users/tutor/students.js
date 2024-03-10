document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".dash-container");

  function removeFetch() {
    const removeBtn = document.querySelectorAll(".remove-student");
    if (removeBtn != null) {
      removeBtn.forEach((btn) => {
        btn.addEventListener("click", () => {
          const reqId = btn.dataset.requestId;

          $.ajax({
            type: "POST",
            url: "./requestAction.php",
            data: { reqId: reqId },
            success: (response) => {
              container.innerHTML = response;
              removeFetch();
            },
          });
        });
      });
    }
  }

  removeFetch();
});
