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
