document.addEventListener("DOMContentLoaded", () => {
  const chatList = document.querySelector(".chat-list");
  const messages = document.querySelector(".messages");
  let isFirstFetch = true; // Flag to track if it's the first fetch

  // Load list of chatted tutors
  $.ajax({
    type: "POST",
    url: "./messageStoreFetch.php",
    data: { loaded: true },
    success: function (response) {
      chatList.innerHTML = response;

      // Function to fetch messages for a specific chat
      function fetchMessages(chat) {
        $.ajax({
          type: "POST",
          url: "./messageStoreFetch.php",
          data: {
            chatId: chat.dataset.tutorChatId,
          },
          success: function (response) {
            const responseText = JSON.parse(response);
            const name = document.querySelector(".chat-name");

            // Clear existing messages
            messages.innerHTML = "";

            // Update chat name
            name.innerHTML = "<h2>" + responseText[0].name + "</h2>";

            // Render messages
            responseText.forEach((msgResponse) => {
              const messageHTML = msgResponse.html;
              messages.innerHTML += messageHTML;
            });

            // Scroll to bottom only on the first fetch
            if (isFirstFetch === true) {
              messages.scrollTop = messages.scrollHeight;
              isFirstFetch = false;
            }
          },
        });
      }

      // Fetch message when chat tutor is clicked
      const chats = document.querySelectorAll(".chat-tutor");
      const inputSend = document.querySelector(".message-send");

      let activeChat = null;
      let fetchInterval = null;

      chats.forEach((chat) => {
        chat.addEventListener("click", () => {
          activeChat = chat;
          fetchMessages(activeChat);
          inputSend.innerHTML = `<input type="text" id="send-message">
                                      <button id="send-btn">Send</button>`;
          setTimeout(() => {
            messages.scrollTop = messages.scrollHeight;
          }, 500);

          const sendBtn = document.getElementById("send-btn");
          sendBtn.removeEventListener("click", sendMessage);
          sendBtn.addEventListener("click", () => sendMessage(activeChat));

          // Fetch messages periodically for the active chat
          clearInterval(fetchInterval); // Clear any existing interval
          fetchInterval = setInterval(() => {
            fetchMessages(activeChat);
          }, 2000);
        });
      });

      // Function to send a message
      function sendMessage(chat) {
        const sendBtn = document.getElementById("send-btn");
        const sendMsg = document.getElementById("send-message");
        if (sendMsg.value != "") {
          $.ajax({
            type: "POST",
            url: "./messageStoreFetch.php",
            data: {
              message: sendMsg.value,
              messagesId: chat.dataset.tutorChatId,
            },
            success: function (messageResponse) {
              sendMsg.value = "";
              fetchMessages(chat);
              setTimeout(() => {
                messages.scrollTop = messages.scrollHeight;
              }, 500);
            },
          });
        }
      }
    },
  });
});
