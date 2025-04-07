function swapVue(vue){

    let tweet = document.getElementById('tweet');
    let myaccount = document.getElementById('myaccount');
    let message = document.getElementById('message');
    let follow = document.getElementById('follow');
    let followed = document.getElementById('followed');



    tweet.classList.remove("fade-in");
    myaccount.classList.remove("fade-in");
    message.classList.remove("fade-in");
    follow.classList.remove("fade-in");
    followed.classList.remove("fade-in");


    switch (vue) {
        case "myaccount":
            console.log("myaccount")
            tweet.classList.add("hidden")
            message.classList.add("hidden")
            follow.classList.add("hidden")
            followed.classList.add("hidden")
            myaccount.classList.remove("hidden")
            myaccount.classList.add("fade-in")
            break;
        case "message":
            console.log("message")
            myaccount.classList.add("hidden")
            tweet.classList.add("hidden")
            follow.classList.add("hidden")
            followed.classList.add("hidden")
            message.classList.remove("hidden")
            message.classList.add("fade-in")
            break;
        case "tweet":
            console.log("tweet")
            myaccount.classList.add("hidden")
            message.classList.add("hidden")
            follow.classList.add("hidden")
            followed.classList.add("hidden")
            tweet.classList.remove("hidden")
            tweet.classList.add("fade-in")
            break;
        case "follow":
            myaccount.classList.add("hidden")
            message.classList.add("hidden")
            tweet.classList.add("hidden")
            followed.classList.add("hidden")
            follow.classList.remove("hidden")
            follow.classList.add("fade-in")
            break;
        case "followed":
            myaccount.classList.add("hidden")
            message.classList.add("hidden")
            tweet.classList.add("hidden")
            follow.classList.add("hidden")
            followed.classList.remove("hidden")
            followed.classList.add("fade-in")
            break;
        default:
            break;
    }
    
}

function swapTheme(){
    if(document.body.dataset.theme == "light"){
        document.body.dataset.theme="dark"
    }else{
        document.body.dataset.theme="light"
    }
    
}

document.addEventListener('DOMContentLoaded', () => {
  const darkModeToggle = document.getElementById('dark-mode-toggle');
  if (localStorage.getItem('darkMode') === 'dark') {
    console.log("dark")
    document.body.dataset.theme="dark"
  }else{
    console.log("light")
    document.body.dataset.theme="light"
  }
  console.log(localStorage.getItem('darkMode'));

  darkModeToggle.addEventListener("click", () => {
    if (localStorage.getItem('darkMode') === 'light') {
        localStorage.setItem("darkMode", "dark");
        document.body.dataset.theme="dark"
    }else{
        localStorage.setItem("darkMode", "light");
        document.body.dataset.theme="light"
    }
  })

});
