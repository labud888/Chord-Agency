$(document).ready(function() {
    $('#done').on('change', function() {
        var str = $("form").serialize(),
            school = $("#school").empty(),
            address = $("#address").empty(),
            bus = $("#bus").empty();
        $.ajax({
            url: '/travel',
            type: 'post',
            dataType: 'json',
            data: str,
            success: function(data) {
                console.log(data);
                if (data.busstops.length) {
                    $.each(data.busstops, function(key, value) {
                        bus.html("<li  style='display:block;'>" + value.name + ' &nbsp; ' + value.postcode_id + "</li>");
                    });
                } else {
                    bus.html("<li>No Bus stops in that area!</li>");
                }
                if (data.schools.length) {
                    $.each(data.schools, function(key, value) {
                        school.append("<li>" + value.name + "</li>");
                    });
                } else {
                    school.html("<li>No Schools in that area!</li>");
                }
                if (data.addresses.length) {
                    $.each(data.addresses, function(key, value) {
                        address.html("<li>" + value.district + ' &nbsp; ' + value.locality + ' &nbsp; ' + value.street + ' &nbsp; ' + value.site + ' &nbsp; ' + value.site_number + ' &nbsp; ' + value.site_description + ' &nbsp; ' + value.site_subdescription + ' &nbsp; ' + value.postcode_id + "</li>");
                    });
                } else {
                    address.html("<li>No Addresses for that area!</li>");
                }
            }
        });
    });
});