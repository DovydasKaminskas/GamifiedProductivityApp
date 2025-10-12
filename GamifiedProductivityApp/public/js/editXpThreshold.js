
var selectedPriority;
$('#priority').change(function(){
    selectedPriority = $(this).val();
    if(selectedPriority == "Low") {
        $('#xp').attr('min', '1');
        $('#xp').attr('max', '50');
        $('#xpInfo').text("Enter XP between 1 and 50");
    }
    else if(selectedPriority == "Medium") {
        $('#xp').attr('min', '51');
        $('#xp').attr('max', '100');
        $('#xpInfo').text("Enter XP between 51 and 100");
    }
    else if(selectedPriority == "High") {
        $('#xp').attr('min', '101');
        $('#xp').attr('max', '150');
        $('#xpInfo').text("Enter XP between 101 and 150");
    }
    else if(selectedPriority == "Very high") {
        $('#xp').attr('min', '151');
        $('#xp').attr('max', '200');
        $('#xpInfo').text("Enter XP between 151 and 200");
    }
})

// Functionality which sets min value of due_to as a today's date and time
var now = new Date();
now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
document.getElementById('due_to').min = now.toISOString().slice(0,16);
