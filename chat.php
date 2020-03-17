 <?php include 'menu.php'; ?>
  
  <div class="form chat">
    <div class="chat__group">
      <input type="checkbox" id="chat__activate">
      <label for="chat__activate">Activate chat</label>
    </div>
    <div class="form__group">
      <textarea class="chat__room" disabled></textarea>
    </div>
    <form class="chat__form">
      <div class="form__group">
        <label for="username">Username:</label>
        <input id="username" name="username" type="text" disabled>
      </div>
      <div class="form__group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" class="chat__message" disabled></textarea>
      </div>
      <div class="form__group">
        <button role="submit" class="chat__send" disabled>Send</button>
      </div>
    </form>
  </div>

  <script src="chat.js"></script>
</body>
</html>
