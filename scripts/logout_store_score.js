function logout() {
    let temp = parseInt(localStorage.getItem("highScoreStore"));
    localStorage.removeItem("highScoreStore");
    location.href = "includes/site.logout.php?score=" + temp;
}