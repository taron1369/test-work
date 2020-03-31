function datepicker() {
    $('.input-daterange input').each(function () {
	$(this).datepicker('clearDates');
    });
}

function findIndex(id) {

    var rem = document.getElementsByClassName('del');
    var index = 0;

    for (var i = 0; rem.length > i; i++) {
	if (String(rem[i].onclick).indexOf(id) + 1 !== 0) {
	    index = i;
	}
    }

    return index;
}

function show_result(action = null, text = null) {
    
    var n = document.getElementsByClassName('alert'),
    error = document.getElementsByClassName('error_text');
    
    if (action == null) {
	
	n[0].style.display = 'none';
	n[1].style.display = 'none';
	error[0].innerHTML = '';
	error[1].innerHTML = '';
	
    } else if (action == 'success') {
	
	n[0].style.display = 'none';
	n[1].style.display = 'block';
	
	    if (text == null) {
		text = '';
	    }
	    
	error[0].innerHTML = '';
	error[1].innerHTML = text;
	
    } else {
	
	n[0].style.display = 'block';
	n[1].style.display = 'none';
	
	    if (text == null) {
		text = '';
	    }
	
	error[0].innerHTML = text;
	error[1].innerHTML = '';
    }
}

function hide_result() {

    setTimeout(function () {
	show_result();
    }, 10000);

}

function del(id) {

    var index = Number(findIndex(id)) + 2, row = document.getElementsByTagName('tr');

    $.ajax({type: 'POST', cache: false, url: location.origin + '/', data: {'action': 'delete', 'id': id}, error: function () { alert('connection refused'); }, success: function (msg) {

	    if (msg == 'success') { row[index].remove(); }
	    read();

	}});
}

function update(id) {

    var index = findIndex(id),
    name = document.getElementsByClassName('name'),
    surename = document.getElementsByClassName('surename'),
    date = document.getElementsByClassName('date'),
    phone = document.getElementsByClassName('mobile'),
    email = document.getElementsByClassName('email');

    $.ajax({type: 'POST', cache: false, url: location.origin + '/', data: {'action': 'update', 'id': id, 'data': [name[index].value, surename[index].value, date[index].value, phone[index].value, email[index].value]}, error: function () { alert('connection refused'); }, success: function (msg) {

	    if (String(msg) == 'success') {

		show_result('success', 'Data successfully updated');
		hide_result();
		read();

	    } else if (String(msg).indexOf(': invalid data') + 1 !== 0) {

		msg = String(msg).split(':'); if (msg[0] == 'word') { show_result('fail', 'Name/surename is not valid'); } else if (msg[0] == 'date') { show_result('fail', 'Date of birth is not valid'); } else if (msg[0] == 'phone') { show_result('fail', 'Phone is not valid'); } else if (msg[0] == 'email') { show_result('fail', 'Email is not valid'); } else { show_result('fail'); }
		hide_result();

	    }

	}});

}

function read() {

    $.ajax({type: 'POST', cache: false, url: location.origin + '/', data: {'action': 'read'}, error: function () {
	    alert('error');
	}, success: function (msg) {
	    
	    var body = document.getElementById('data'), data = '', dates = [];
	    
	    msg = JSON.parse(msg);
	    
	    for (var i = 0; msg.length > i; i++) {
		dates.push(msg[i].date);
		data += "<tr><td><input class='name form-control text-center' value='" + msg[i].name + "' placeholder='Name'></td><td><input type='text' class='surename form-control text-center' value='" + msg[i].surename + "' placeholder='Surename'></td><td><div class='input-group input-daterange'><input type='text' class='date form-control text-center' id='range-picker-1' style='border-radius:3px 3px 3px 3px;' data-date-format='dd-mm-yyyy' value=''></div></td><td><input type='text' class='mobile form-control text-center' value='" + msg[i].phone + "'></td><td><input type='email' class='email form-control text-center' value='" + msg[i].email + "'></td><td><input type='button' class='save btn btn-success btn-floating' value='save' onclick=\"update('" + msg[i].id + "');\"></td><td><input type='button' class='del btn btn-danger btn-floating' value='delete' onclick=\"del('" + msg[i].id + "');\"></td><tr>";
	    }

	    body.innerHTML = data;
	    datepicker();
	    var date = document.getElementsByClassName('date');

	    for (var i = 0; date.length > i; i++) {
		date[i].placeholder = '00-00-0000';
		if (i !== 0) {
		    var index = i - 1;
		    date[i].value = dates[index];
		}
	    }

	}});

}

function create() {

    var name = document.getElementsByClassName('name'),
    surename = document.getElementsByClassName('surename'),
    date = document.getElementsByClassName('date'),
    phone = document.getElementsByClassName('mobile'),
    email = document.getElementsByClassName('email'),
    save = document.getElementsByClassName('save'),
    rem = document.getElementsByClassName('del');

    $.ajax({type: 'POST', cache: false, url: location.origin + '/', data: {'action': 'create', 'data': [name[0].value, surename[0].value, date[0].value, phone[0].value, email[0].value]}, error: function () { alert('connection refused'); }, success: function (msg) {

	    if (String(msg) == 'success') {

		name[0].value = '';
		surename[0].value = '';
		date[0].value = '';
		phone[0].value = '';
		email[0].value = '';
		show_result('success', 'You successfully added data into table');
		hide_result();
		read();

	    } else if (String(msg).indexOf(': invalid data') + 1 !== 0) {

		msg = String(msg).split(':'); if (msg[0] == 'word') { show_result('fail', 'Name/surename is not valid'); } else if (msg[0] == 'date') { show_result('fail', 'Date of birth is not valid'); } else if (msg[0] == 'phone') { show_result('fail', 'Phone is not valid'); } else if (msg[0] == 'email') { show_result('fail', 'Email is not valid'); } else { show_result('fail'); }
		hide_result();
	    }

	}});

}

function run() {

    var save = document.getElementsByClassName('save'),
    rem = document.getElementsByClassName('del');

    save[0].onclick = function () { create(); };
    rem[0].onclick = function () { del(); };

    read();
}

run();