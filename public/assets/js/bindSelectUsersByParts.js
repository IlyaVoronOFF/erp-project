$('#parts').change(function() {
    arrUsersParts = [];
    value = $(this).val();

    $('#usersSelect div.nice-select ul li.option').not('[data-value=0]').hide();

    usersParts.forEach(e => {
        if (e.part_id == value) {
            arrUsersParts.push(e.user_id);
        }
    });

    arrUsersParts.forEach(el => {
        $('#usersSelect div.nice-select ul li[data-value=' + el + ']').show();
    });
})