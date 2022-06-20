/* 入力チェック お名前・お問い合わせ内容*/
function nameCheck(e) {
  if (e && e.value) {
    e.style.backgroundColor = "#FFF";
  } else if (e && !e.value) {
    e.style.backgroundColor = "#FDD";
  }
}

/* 入力チェックメールアドレス */
function emailCheck(e) {
  if (
    e &&
    e.value &&
    e.value.match(
      /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/
    )
  ) {
    e.style.backgroundColor = "#FFF";
  } else if (
    e &&
    (!e.value ||
      !e.value.match(
        /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]+.[A-Za-z0-9]+$/
      ))
  ) {
    e.style.backgroundColor = "#FDD";
  }
}

setTimeout(function () {
  //ページリロード時
  if (
    document.getElementById("inputName") &&
    document.getElementById("inputEmail") &&
    document.getElementById("inputContent")
  ) {
    nameCheck(document.getElementById("inputName"));
    nameCheck(document.getElementById("inputEmail"));
    nameCheck(document.getElementById("inputContent"));
  }
}, 100);
