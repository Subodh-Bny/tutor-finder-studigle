/* const chatBtns = document.querySelectorAll(".chat-open");
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
}); */
const container = document.querySelector(".dash-container");
function removeFetch() {
  const removeBtn = document.querySelectorAll(".remove-tutor");
  if (removeBtn != null) {
    removeBtn.forEach((btn) => {
      btn.addEventListener("click", () => {
        const reqId = btn.dataset.requestId;

        $.ajax({
          type: "POST",
          url: "./tutorDelete.php",
          data: { reqId: reqId },
          success: (response) => {
            container.innerHTML = response;
            location.reload();

            removeFetch();
          },
        });
      });
    });
  }
}

removeFetch();

const chatBtns = document.querySelectorAll(".chat-open");
function chatOpen() {
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
          chatOpen();
          console.log(response);
        },
      });
    });
  });
}
chatOpen();
