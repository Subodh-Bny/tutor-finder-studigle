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

  const chatBtns = document.querySelectorAll(".chat-open");
  chatBtns.forEach((chatBtn) => {
    chatBtn.addEventListener("click", () => {
      const chatId = chatBtn.dataset.chatId;
      // console.log(chatId);
      $.ajax({
        type: "POST",
        url: "./setChatSession.php",
        data: { chatId: chatId },

        success: function (response) {
          // window.location.href = "./message/messages.php";
          console.log(response);
        },
      });
    });
  });
});
