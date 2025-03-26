try {
  const referencedate = document.getElementById("countdown-timer").dataset.time;

  var timestamp = referencedate - Date.now() / 1000;

  function component(x, v) {
    return Math.floor(x / v);
  }

  setInterval(function () {
    timestamp = Math.max(0, timestamp - 1);
    if (timestamp <= 0) {
      location.reload();
    }
    var days = component(timestamp, 24 * 60 * 60),
      hours = component(timestamp, 60 * 60) % 24,
      minutes = component(timestamp, 60) % 60,
      seconds = component(timestamp, 1) % 60;

    document.getElementById("countdown-days-number").innerText = days;
    document.getElementById("countdown-hours-number").innerText = hours;
    document.getElementById("countdown-minutes-number").innerText = minutes;
    document.getElementById("countdown-seconds-number").innerText = seconds;
  }, 1000);
} catch (err) {
  console.log(err);
}
