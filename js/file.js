var messageBody = document.querySelector('#messageBody');
if (messageBody != null) {
    messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
}
function setFocusToTextBox() {

    let add = document.getElementById("addMessage");
    if (add != null) {
        add.focus();
    }
}
setFocusToTextBox();
