function logout() {
    localStorage.removeItem("highScoreStore");
    location.href = "/includes/site.logout.php?score=" + parseInt(localStorage.getItem("highScoreStore"));
}