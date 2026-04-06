<form action="{{ route('cab-enquiry.store') }}" method="POST" class="bg-white rounded shadow p-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Name</label>
            <input type="text" class="form-control form-control-sm rounded-3" name="name" placeholder="Enter Name" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control form-control-sm rounded-3" name="phone" placeholder="Phone" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Pick Up Location</label>
            <input type="text" class="form-control form-control-sm rounded-3" name="pickup_location" placeholder="Pick Up Location" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Drop Off Location</label>
            <input type="text" class="form-control form-control-sm rounded-3" name="drop_location" placeholder="Drop Off Location" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Cab Type</label>
            <select class="form-select form-select-sm rounded-3" name="vehicle_type" required>
                <option value="">Choose Cab</option>
                <option value="5 Seater">5 Seater</option>
                <option value="Sedan">Sedan</option>
                <option value="SUV">SUV</option>
                <option value="Tempo Traveler">Tempo Traveler</option>
                <option value="Luxury">Luxury</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Pick Up Date</label>
            <input type="date" class="form-control form-control-sm rounded-3" name="date" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" class="form-control form-control-sm rounded-3" name="email" placeholder="Email" required>
        </div>
    </div>
    <div class="d-grid mt-4">
        <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold shadow">Send Enquiry</button>
    </div>
</form>
