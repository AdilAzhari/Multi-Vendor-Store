import './bootstrap';

var channel = Echo.private('app.models.user.${userId}');
channel.notification(function(data) {
  console.log(data);
  alert(data.bodhy);
  alert(JSON.stringify(data));
});
