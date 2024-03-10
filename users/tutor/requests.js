const reqContainer = document.querySelector(".dash-container ul");
document.addEventListener("DOMContentLoaded", function () {
  $.ajax({
    type: "POST",
    url: "./fetchRequests.php",
    success: function (response) {
      reqContainer.innerHTML = response;

      function rejectReq() {
        const rejectBtns = document.querySelectorAll(".reject-btn");
        rejectBtns.forEach((rejectBtn) => {
          rejectBtn.addEventListener("click", () => {
            const rejectId = rejectBtn.dataset.rejectId;

            $.ajax({
              type: "POST",
              url: "./requestAction.php",
              data: { reject_id: rejectId },

              success: function () {
                $.ajax({
                  type: "POST",
                  url: "./fetchRequests.php",
                  success: function (response) {
                    reqContainer.innerHTML = response;
                    rejectReq();
                  },
                });
              },
            });
          });
        });
      }
      function renderFetch() {
        const acceptBtns = document.querySelectorAll(".accept-btn");
        acceptBtns.forEach((acceptBtn) => {
          acceptBtn.addEventListener("click", () => {
            const acceptId = acceptBtn.dataset.acceptId;

            $.ajax({
              type: "POST",
              url: "./requestAction.php",
              data: { accept_id: acceptId },

              success: function () {
                $.ajax({
                  type: "POST",
                  url: "./fetchRequests.php",
                  success: function (response) {
                    reqContainer.innerHTML = response;
                    renderFetch();
                  },
                });
              },
            });
          });
        });
      }

      rejectReq();
      renderFetch();
    },
  });
});
