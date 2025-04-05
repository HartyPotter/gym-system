function selectPlan(planType) {
    // Remove selected class from all plans
    document.querySelectorAll('.plan').forEach(plan => {
        plan.classList.remove('selected');
    });
    
    // Add selected class to clicked plan
    const selectedPlan = document.querySelector(`.plan:has(h3:contains("${planType.charAt(0).toUpperCase() + planType.slice(1)} Plan"))`);
    selectedPlan.classList.add('selected');
    
    // Update the plan input
    document.getElementById('plan').value = `${planType.charAt(0).toUpperCase() + planType.slice(1)} Plan`;
}

function bookSession() {
    // Get form values
    const plan = document.getElementById('plan').value;
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time');
    const trainer = document.getElementById('trainer');

    // Validate form
    if (!plan || !name || !email || !date || !time.value) {
        alert('Please fill in all required fields and select a plan');
        return;
    }

    // Format the booking details
    const timeText = time.options[time.selectedIndex].text;
    const trainerText = trainer.value ? 
        trainer.options[trainer.selectedIndex].text : 
        'No trainer requested';

    // Display confirmation
    const confirmation = document.getElementById('confirmation');
    const bookingDetails = document.getElementById('booking-details');
    
    bookingDetails.innerHTML = `
        Selected Plan: ${plan}<br>
        Name: ${name}<br>
        Email: ${email}<br>
        Date: ${new Date(date).toLocaleDateString()}<br>
        Time: ${timeText}<br>
        Trainer: ${trainerText}
    `;

    confirmation.classList.remove('hidden');

    // Clear form
    document.getElementById('plan').value = '';
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('date').value = '';
    document.getElementById('time').value = '';
    document.getElementById('trainer').value = '';
    
    // Remove selected class from plans
    document.querySelectorAll('.plan').forEach(plan => {
        plan.classList.remove('selected');
    });
}

// Set minimum date to today
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const today = new Date().toISOString().split('T')[0];
    dateInput.min = today;
});

// Fix for :has selector in JavaScript
document.querySelectorAll('.plan').forEach(plan => {
    plan.addEventListener('click', function() {
        const planName = this.querySelector('h3').textContent.toLowerCase().replace(' plan', '');
        selectPlan(planName);
    });
});