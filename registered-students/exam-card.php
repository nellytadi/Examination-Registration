<html>
<head>
    <style>
        body{font-family:Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;word-wrap:break-word;background:#e1f7fe;margin:0}.logo{margin-top:10px;max-width:100px}.light_blue{font-size:20px;color:#5f9ea0}.top_row{background:#302a6b;padding:1px 0 1px 15px}.yellow{color:#fabb13;font-size:24px}.white_small{color:#fff;font-size:14px}.text-shadow{color:#fff;font-size:22px;margin-top:-15px;padding-bottom:10px}.text-shadow-yellow{color:#e32726;font-size:24px;margin:0}.passport{width:150px}.bg_blue{background-color:#e1f7fe;padding:0 20px}.exam-card .red_bg{background-color:pink;padding:10px;text-transform:uppercase}.exam-card .blue_bg{background-color:#add8e6;padding:10px;text-transform:uppercase}.exam-card .green_bg{background-color:#90ee90;padding:10px;text-transform:uppercase}.exam-card .check-field{border:1px solid #000;background-color:#fff;padding:5px 15px;width:10px;height:10px;float:right}.exam-card .passport{background-color:#fff}.exam-card div{text-transform:uppercase;font-size:12px}.exam-card .sign_field{border:1px solid #000;width:100%;height:50px;background-color:#fff}.form-row .form-group{margin-top:5px;width:100%;margin-bottom:20px}.half-field{background:#fff;font-weight:700;margin:20px;padding:3px 10px}.float-right{float:right}
    </style>
</head>
<body>
<div class="row top_row">
    <div class="float-right">
        <img src="http://localhost/national-mathematics-competition/asset/lavogue-logo.png" class=" logo"
             alt="Lavogue Schools">
        <img src="http://localhost/national-mathematics-competition/asset/nmc_logo.png" class="logo"
             alt="National Mathematics Competition">

    </div>
    <div class="text-uppercase">
        <h1>
            <div class="yellow">La-vogue</div>
            <div class="white_small">British International Schools</div>

            <div class="light_blue">National Mathematical center, Abuja</div>
        </h1>
        <h2>
            <div class="text-shadow"> National Mathematics Competition</div>

        </h2>
    </div>
</div>
<div class="row bg_blue">
    <div class="col-12">
        <h3 class="text-shadow-yellow">Examination Card</h3>
    </div>
    <div class="form-row exam-card">
        <div class="form-group">
            <img id="blah"
                 src="http://localhost/national-mathematics-competition/asset/passports/<?=$passport?>"
                 alt="Passport" class="img-fluid passport">
        </div>
        <div class="form-group">
            <span>Date</span>
            <span class="half-field"><?=$date?></span>

            <span>Exam number</span>
            <span class="half-field">LVBIS/NMC/<?=$newExamNumber?></span>
        </div>
        <div class="form-group ">
            <span>Surname</span>
            <span class="half-field"><?=$surname?></span>
            <span>Other Names</span>
            <span class="half-field"><?=$other_name?></span>
        </div>
        <div class="form-group ">
            <span>Date of birth</span>
            <span class="half-field"><?=$date_of_birth?></span>
            <span>Gender</span>
            <span class="half-field"><?=$gender?></span>
        </div>
        <div class="form-group ">
            <span>Name of School</span>
            <span class="half-field"><?=$school?></span>
        </div>
        <div class="form-group">
            <span>Class</span>
            <span class="half-field"><?=$class?></span>
            <span>State</span>
            <span class="half-field"><?=$residing_state?></span>
        </div>
        <div class="form-group">
            <label>Examination category (Please choose one and tick as applicable) </label>
        </div>
        <div class="form-group">
            <div class=" small_label red_bg">
                Primary Mathematics Competition
                <div class="check-field"></div>
            </div>
            <div class=" small_label blue_bg">
                Junior Mathematics Competition
                <div class="check-field"></div>
            </div>
            <div class=" small_label  green_bg">
                Senior Mathematics Competition
                <div class="check-field"></div>
            </div>
        </div>
        <div class="form-group">
            <span>Contact Number</span>
            <span class="half-field"><?=$contact_number?></span>
            <span>Email</span>
            <span class="half-field"><?=$email?></span>
        </div>
        <div class="form-group">
            <label>Student Signature</label>
            <div class="sign_field"></div>
        </div>
        <div class="form-group">
            <label>Principal / Head of School Signature and Stamp</label>
            <div class="sign_field"></div>
        </div>
    </div>
</div>
</body>
<html>