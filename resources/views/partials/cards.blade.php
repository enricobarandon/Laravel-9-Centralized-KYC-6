<div class="row">
    <div class="col-md-3">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ number_format($verified) }}</h3>
                <p>Verified Players</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('helpdesk.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-orange">
            <div class="inner">
                <h3>{{ number_format($pending) }}</h3>
                <p>Pending Players</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-timer"></i>
            </div>
            <a href="{{ route('helpdesk.for-approval') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ number_format($disapproved) }}</h3>
                <p>Disapproved Players</p>
            </div>
            <div class="icon">
                <i class="ion ion-ios-timer"></i>
            </div>
            <a href="{{ route('helpdesk.for-approval') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-white">
            <div class="inner">
                <h3>{{ $totalregistered }}</h3>
                <p>Total Registered</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer"><i class="fa fa-info-circle"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $loggedTotay }}</h3>
                <p>Total Logged in Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ route('reports.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ isset($verified) ? number_format(($loggedTotay * 100)/ $verified, 1) : '0' }}<sup style="font-size: 20px">%</sup></h3>
                <p>Logged in Today</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('reports.index') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>