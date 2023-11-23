function updateProfile() {
    var updatedProfile = {
        name: $('#name').val(),
        age: $('#age').val(),
        dob: $('#dob').val(),
        contact: $('#contact').val(),
        fatherName: $('#fatherName').val(),
        motherName: $('#motherName').val(),
        address: $('#address').val(),
        city: $('#city').val(),
        state: $('#state').val(),
        country: $('#country').val(),
        currentPosition: $('#currentPosition').val(),
        sessionId: localStorage.getItem('sessionId')
    };

    $.ajax({
        type: 'POST',
        url: 'php/profile.php',
        data: updatedProfile,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert('Profile updated successfully!');
            } else {
                alert('Failed to update profile. Please try again.');
            }
        },
        error: function(error) {
            console.error('Error updating profile:', error);
            alert('An error occurred while updating the profile. Please try again.');
        }
    });
}