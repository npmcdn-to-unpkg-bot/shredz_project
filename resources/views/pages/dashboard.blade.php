@inject('pageComponent', 'App\Http\Components\Page')
@extends('themes.default.layout')
@section('root-class') vip-wholesale @stop
@section('page-title')  @stop
@section('metas')
<meta name="category" content="{{ strtolower(trim(@$category)) }}">
@append

@section('content')
    <div class="dashboard-wrapper">
        <div class="main-dashboard-holder">
            <div class="menu-header">
                <a href="#" class="menu-opener"><i class="fa fa-bars"></i></a>
            </div>
            <div class="dashboard-title">
                <h1>Dashboard</h1>
            </div>
            <div class="container-fluid">
                <div class="dashboard-panel">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-group01-01">sales</a>
                        </li>
                        <li>
                            <a href="#tab-group01-02">orders</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-group01-01">
                            <div class="sales-detail">
                                <div class="row">
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Yesterday</span>
                                            <strong>$1,207.98</strong>
                                            <p>32 POINTS / 9 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Today</span>
                                            <strong>$787.00</strong>
                                            <p>5 POINTS / 2 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Week</span>
                                            <strong>$1,994.98</strong>
                                            <p>37 POINTS / 11 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Month</span>
                                            <strong>$17,040.93</strong>
                                            <p>437 POINTS / 143 SALES</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-group01-02">
                            <div class="sales-detail">
                                <div class="row">
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Yesterday</span>
                                            <strong>$1,207.98</strong>
                                            <p>32 POINTS / 9 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Today</span>
                                            <strong>$787.00</strong>
                                            <p>5 POINTS / 2 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Week</span>
                                            <strong>$1,994.98</strong>
                                            <p>37 POINTS / 11 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Month</span>
                                            <strong>$17,040.93</strong>
                                            <p>437 POINTS / 143 SALES</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-group02-01">pending</a>
                        </li>
                        <li>
                            <a href="#tab-group02-02">approved</a>
                        </li>
                        <li>
                            <a href="#tab-group02-03">revoked</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-group02-01">
                            <div class="table-data-block">
                                <header>
                                    <form action="#" class="search-form">
                                        <div class="left-form">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="right-form">
                                            Display
                                            <div class="select-box row-select">
                                                <select>
                                                    @for($i = 1; $i <= 100; $i++)
                                                        <option>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </header>
                                <table class="table alternate">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th>EMAIL</th>
                                            <th>PHONE</th>
                                            <th>
                                                <div class="small-select">
                                                    <select>
                                                        <option>status</option>
                                                        <option>status 1</option>
                                                        <option>status 2</option>
                                                        <option>status 3</option>
                                                    </select>
                                                </div>
                                            </th>
                                            <th>LAST ACTION DATE</th>
                                            <th>PRIORITY</th>
                                            <th>CERTIFIED METHOD</th>
                                            <th>SIGN UP DATE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 0; $i < 10; $i++)
                                            <tr>
                                                <td>Rosaly Monderie</td>
                                                <td>rosaly16_rochon@live.fr</td>
                                                <td>(929) <br>888-8090</td>
                                                <td>Terms of <br>Service Signed</td>
                                                <td>Jul 27, 2016</td>
                                                <td>0</td>
                                                <td>Certification <br>Photo Uploaded</td>
                                                <td>Jul 27, 2016</td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                                <div class="table-footer">
                                    <div class="left-info">
                                        <p>Showing 1 to 100 of 15,935 entries</p>
                                    </div>
                                    <div class="right-part">
                                        <ul class="pagination">
                                            <li class="active"><span>1</span></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">3</a></li>
                                            <li class="disabled"><span>...</span></li>
                                            <li><a href="#">158</a></li>
                                            <li><a href="#">159</a></li>
                                            <li><a href="#">160</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-group02-02">
                            <div class="table-data-block">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et voluptas provident, a nesciunt id, similique unde neque non magni architecto!</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-group02-03">
                            <div class="table-data-block">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint delectus quasi similique iusto voluptas velit reprehenderit sequi quam, est cum?</p>
                            </div>
                        </div>
                    </div>
                    <div class="extra-buttons">
                        <a href="#" class="btn btn-danger">EXPORT USER TABLE</a>
                    </div>
                </div>

                <div class="dashboard-panel bordered">
                    <div class="table-data-block">
                        <header class="clearfix">
                            <a href="#" class="btn btn-success pull-right"><i class="fa fa-plus"></i> ADD USER</a>
                            <strong>USERS</strong>
                        </header>
                        <header>
                            <form action="#" class="search-form">
                                <div class="left-form">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="right-form">
                                    Display
                                    <div class="select-box row-select">
                                        <select>
                                            @for($i = 1; $i <= 100; $i++)
                                                <option>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </header>
                        <table class="table alternate">
                            <thead>
                                <tr>
                                    <th>USER NAME</th>
                                    <th>ROLE</th>
                                    <th>EMAIL</th>
                                    <th>LOCATION</th>
                                    <th>DETAILS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < 10; $i++)
                                    <tr>
                                        <td>Rosaly Monderie</td>
                                        <td>Trainer</td>
                                        <td>rosaly16_rochon@live.fr</td>
                                        <td>New Jersey</td>
                                        <td><a href="#">EDIT USER <i class="fa fa-caret-right"></i></a></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                        <div class="table-footer">
                            <div class="left-info">
                                <p>Showing 1 to 100 of 16,622 entries</p>
                            </div>
                            <div class="right-part">
                                <ul class="pagination">
                                    <li class="active"><span>1</span></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">3</a></li>
                                    <li class="disabled"><span>...</span></li>
                                    <li><a href="#">158</a></li>
                                    <li><a href="#">159</a></li>
                                    <li><a href="#">160</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-group03-01">latest orders</a>
                        </li>
                        <li>
                            <a href="#tab-group03-02">latest refunds</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-group03-01">
                            <div class="table-data-block">
                                <header>
                                    <form action="#" class="search-form">
                                        <div class="left-form">
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Search">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="right-form">
                                            Display
                                            <div class="select-box row-select">
                                                <select>
                                                    @for($i = 1; $i <= 100; $i++)
                                                        <option>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </header>
                                <table class="table alternate">
                                    <thead>
                                        <tr>
                                            <th>clients</th>
                                            <th>amount</th>
                                            <th>email</th>
                                            <th>trainer</th>
                                            <th>DATE</th>
                                            <th>products</th>
                                        </tr>
                                    </thead>
                                    @for($i = 0; $i < 10; $i++)
                                    <tbody class="open-close">
                                        <tr>
                                            <td>Rosaly Monderie</td>
                                            <td>$178.99</td>
                                            <td>rosaly16_rochon@live.fr</td>
                                            <td>Reid Stubblefield</td>
                                            <td>Jul 27, 2016</td>
                                            <td>
                                                <a href="#" class="opener">view orders <i class="fa fa-caret-down"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="inner-table-holder">
                                                <div class="slide inner-table-holder">
                                                    <table class="table inner-table">
                                                        <thead>
                                                            <tr>
                                                                <th>order details</th>
                                                                <th colspan="2">Details</th>
                                                                <th>Quantity</th>
                                                                <th colspan="2">Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @for($j = 1; $j < 4; $j++)
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ asset('images/dashboard-product01.png') }}" alt="asset">
                                                                </td>
                                                                <td colspan="2">
                                                                    Chocolate Cookie DoughProtein Bar <br> Made for Women (Case of 12)
                                                                </td>
                                                                <td>1</td>
                                                                <td colspan="2">$22.99</td>
                                                            </tr>
                                                            @endfor
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endfor
                                </table>
                                <div class="table-footer">
                                    <div class="left-info">
                                        <p>Showing 1 to 100 of 3,488 entries</p>
                                    </div>
                                    <div class="right-part">
                                        <ul class="pagination">
                                            <li class="active"><span>1</span></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">3</a></li>
                                            <li class="disabled"><span>...</span></li>
                                            <li><a href="#">158</a></li>
                                            <li><a href="#">159</a></li>
                                            <li><a href="#">160</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-group03-02">
                            <div class="table-data-block">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex suscipit quidem quisquam, modi illo tempora, cupiditate possimus! Ad, alias ipsum.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="profile-editor">
                    <div class="row">
                        <div class="col-sm-6 col-lg-5">
                            <header class="editor-header">
                                <h4 class="clearfix">edit user <a href="#" class="pull-right"><i class="fa fa-times"></i></a></h4>
                                <form action="#" class="profile-pic-form">
                                    <div class="file-block">
                                        <input type="file">
                                        <i class="fa fa-plus"></i>
                                        add photo
                                    </div>
                                </form>
                            </header>
                            <div class="editor-main no-height">
                                <form action="#" class="profile-editor-form">
                                    <div class="title-area">
                                        <strong class="title">Personal Information</strong>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="first-name01">First Name</label>
                                            <input id="first-name01" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="last-name01">Last Name</label>
                                            <input id="last-name01" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="email01">Email</label>
                                            <input id="email01" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="contact-phone01">Contact Phone</label>
                                            <input id="contact-phone01" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="gender-select01">Gender</label>
                                            <div class="select-box">
                                                <select id="gender-select01">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="title-area">
                                        <strong class="title">Address Information</strong>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="street-address01">Street Address</label>
                                            <input type="text" id="street-address01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="city01">City</label>
                                            <input type="text" id="city01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="zip-code01">Zip Code</label>
                                            <input type="text" id="zip-code01">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="choose-state01">Choose State</label>
                                            <div class="select-box">
                                                <select id="choose-state01">
                                                    <option>State 1</option>
                                                    <option>State 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-field">
                                            <label for="time-zone01">Time Zone</label>
                                            <div class="select-box">
                                                <select id="time-zone01">
                                                    <option>Zone 1</option>
                                                    <option>Zone 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="editor-buttons">
                                <a href="#" class="btn-left btn btn-profile">EDIT QUESTIONNAIRE</a>
                                <a href="#" class="btn btn-right btn-save">SUBMIT</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-5">
                            <div class="editor-main no-height">
                                <div class="title-area">
                                    <h3 class="clearfix">edit questionnaire <a href="#" class="pull-right"><i class="fa fa-times"></i></a></h3>
                                </div>
                                <br>
                                <form action="#" class="profile-editor-form">
                                    <div class="form-group">
                                        <label>Do you currently take supplements?</label>
                                        <div class="select-box">
                                            <select>
                                                <option disabled selected>No answer selected</option>
                                                <option>Answer 1</option>
                                                <option>Answer 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>How many years have you been in the fitness industry?</label>
                                        <div class="select-box">
                                            <select>
                                                <option disabled selected>No answer selected</option>
                                                <option>Answer 1</option>
                                                <option>Answer 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>What best describes your current role in fitness?</label>
                                        <div class="select-box">
                                            <select>
                                                <option disabled selected>No answer selected</option>
                                                <option>Answer 1</option>
                                                <option>Answer 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Do people ask you for fitness advice for at least once a week?</label>
                                        <div class="select-box">
                                            <select>
                                                <option disabled selected>No answer selected</option>
                                                <option>Answer 1</option>
                                                <option>Answer 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Have you ever worked for another Supplement Company?</label>
                                        <div class="select-box">
                                            <select>
                                                <option disabled selected>No answer selected</option>
                                                <option>Answer 1</option>
                                                <option>Answer 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <input type="submit" class="btn btn-save pull-right" value="SUBMIT">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-group04-01">team sales</a>
                        </li>
                        <li>
                            <a href="#tab-group04-02">personal sales</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-group04-01">
                            <div class="sales-detail">
                                <div class="row sales-row">
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Yesterday</span>
                                            <strong>$1,207.98</strong>
                                            <p>32 POINTS / 9 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Today</span>
                                            <strong>$787.00</strong>
                                            <p>5 POINTS / 2 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Week</span>
                                            <strong>$1,994.98</strong>
                                            <p>37 POINTS / 11 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Month</span>
                                            <strong>$17,040.93</strong>
                                            <p>437 POINTS / 143 SALES</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-group04-02">
                            <div class="sales-detail">
                                <div class="row sales-row">
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Yesterday</span>
                                            <strong>$1,207.98</strong>
                                            <p>32 POINTS / 9 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Today</span>
                                            <strong>$787.00</strong>
                                            <p>5 POINTS / 2 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Week</span>
                                            <strong>$1,994.98</strong>
                                            <p>37 POINTS / 11 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Month</span>
                                            <strong>$17,040.93</strong>
                                            <p>437 POINTS / 143 SALES</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel bordered">
                    <div class="sales-detail">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="row sales-row alternate">
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Yesterday</span>
                                            <strong>$1,207.98</strong>
                                            <p>32 POINTS / 9 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales Today</span>
                                            <strong>$787.00</strong>
                                            <p>5 POINTS / 2 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Week</span>
                                            <strong>$1,994.98</strong>
                                            <p>37 POINTS / 11 SALES</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-lg-3">
                                        <div class="sales-box">
                                            <span class="title">Sales This Month</span>
                                            <strong>$17,040.93</strong>
                                            <p>437 POINTS / 143 SALES</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="info-row-block">
                                    <div class="info-row">
                                        <span>Expected Commision:</span>
                                        <strong>$175.00</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Expected Bonus:</span>
                                        <strong>$75.00</strong>
                                    </div>
                                    <div class="info-row">
                                        <span>Next Payment Day:</span>
                                        <strong>09/20/2016</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="{{ asset('js/pages/wholesale.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>
    <script>
        jQuery('.dashboard-panel .nav-tabs a').click(function(e){
            e.preventDefault();
            jQuery(this).tab('show');
        });
    </script>
@stop