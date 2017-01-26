$(document).ready(function() {
    $('#done').on('change', function() {
        var str = $("form").serialize(),
            school = $("#school"),
            address = $("#address"),
            bus = $("#bus");
        $.ajax({
            url: '/travel',
            type: 'post',
            dataType: 'json',
            data: str,
            success: function(data) {
                console.log(data);
                if (data.busstops.length) {
                    $.each(data.busstops, function(key, value) {
                        bus.html("<td>" + value.name + ' &nbsp; ' + value.postcode_id + "</td>");
                    });
                } else {
                    bus.html("<td>No Bus stops in that area!</td>");
                }
                if (data.schools.length) {
                    $.each(data.schools, function(key, value) {
                        school.html("<td>" + value.name + "</td>");
                    });
                } else {
                    school.html("<td>No Schools in that area!</td>");
                }
                if (data.addresses.length) {
                    $.each(data.addresses, function(key, value) {
                        address.html("<td>" + value.district + ' &nbsp; ' + value.locality + ' &nbsp; ' + value.street + ' &nbsp; ' + value.site + ' &nbsp; ' + value.site_number + ' &nbsp; ' + value.site_description + ' &nbsp; ' + value.site_subdescription + ' &nbsp; ' + value.postcode_id + "</td>");
                    });
                } else {
                    address.html("<td>No Addresses for that area!</td>");
                }
            }
        });
    });
});