// take show id error msg to after sid input

const input_sid = document.getElementById('input_sid')
const show_input_err =  document.getElementById('show_sid_err')

if(show_input_err) {
    input_sid.append(show_input_err)
}


//hide messeges after few secs 
const msg = document.querySelectorAll('.msg')

if (msg) {
    msg.forEach(m => {
        setTimeout(() => {
            m.style.display = 'none'
        }, 3000) 
    })
}

