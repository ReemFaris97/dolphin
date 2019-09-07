var config = {
    apiKey: "AIzaSyAKdjahuyUWnH9dIOVqUmkxkceyqovVXdI",
    authDomain: "dolphin-945e8.firebaseapp.com",
    projectId: "dolphin-945e8",
    messagingSenderId: "589372168300",

};
firebase.initializeApp(config);
const messaging = firebase.messaging();
messaging
    .requestPermission()
    .then(function () {
        return messaging.getToken()
    })
    .then(function (token) {
        /*
                if (token != localStorage.getItem('token')) {
        */
        localStorage.setItem('token', token);
        saveToken(token);
        /*}*/
    })
    .catch(function (err) {
        console.error("Unable to get permission to notify.", err);
    });


// Callback fired if Instance ID token is updated.
messaging.onTokenRefresh(function () {
    messaging.getToken().then(function (refreshedToken) {
        //   setTokenSentToServer(false);
        /*
                if (refreshedToken != localStorage.getItem('token')) {
        */
        localStorage.setItem('token', refreshedToken);
        saveToken(refreshedToken);
        /*}*/
        // ...
    }).catch(function (err) {
        console.error('Unable to retrieve refreshed token ', err);
        // showToken('Unable to retrieve refreshed token ', err);
    });
});

messaging.onMessage(function (payload) {
    console.log(payload.data);
    var message=payload.data.message


     $('#notification-items').append('<div class="m-list-timeline__item">'+
       '<span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>'+
        '<span class="m-list-timeline__text">'+message+'</span>'+
        '</div>'
     );
    $('#notification-items').scrollTop(9999999)
    ;

});


function saveToken(token) {

    $.ajax({
        url: $('meta[name="fcm"]').attr('content'),
        method: 'post',
        data: {
            'token': token
        },
        success: function (res) {
        }
    });
}
