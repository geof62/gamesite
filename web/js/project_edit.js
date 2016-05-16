// keep track of how many email fields have been rendered
var membersCount = '{{ form.members|length }}';

$(document).ready(function() {
    $('#add-another-member').click(function(e) {
        e.preventDefault();

        var memberList = $('#members-fields-list');

        // grab the prototype template
        var newWidget = memberList.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace('/id/g', membersCount);
        membersCount++;

        // create a new list element and add it to the list
        var newLi = $('<li></li>').html(newWidget);
        newLi.appendTo(memberList);
    });
})