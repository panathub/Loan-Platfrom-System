@extends('dashboard.borrower.dashboardlayout')

@section('content')
<div class="header pb-4"  style="background: linear-gradient(90deg, rgba(252,176,69,1) 0%, rgba(253,29,29,1) 71%, rgba(131,58,180,1) 100%);"> 
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Default</h6>
              <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                  <li class="breadcrumb-item"><a href="{{ route('borrower.home') }}"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('borrower.home') }}">Dashboards</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Default</li>
                  </ol>
              </nav>
            </div>
          </div>
      </div>
    </div>
</div>
</div>
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<p style="padding-top: 100px;"></p>

    <?php
    $BorrowerID = Auth::guard('borrower')->user()->BorrowerID;
    $sql="SELECT loaners.*,borrowdetail.* FROM borrowdetail 
    INNER JOIN borrowlist ON borrowlist.borrowlistID = borrowdetail.borrowlistID
    INNER JOIN loaners ON loaners.LoanerID =borrowlist.LoanerID
    WHERE borrowdetail.BorrowerID = $BorrowerID  AND borrowdetail.status = 1";
    $post = DB::select($sql);
    ?>

		<div class="container-fluid mt--7">
			<div class="row">
				<div class="col-md-12">
					<div class="table-wrap">
						<table class="table table-responsive-xl">
						  <thead>
						    <tr>
						
						    	<th>ผู้ให้กู้</th>
                  <th>จำนวนเงิน</th>
						      <th>รายการ</th>
                  <th></th>
						      <th>สถานะ</th>
						
						    </tr>
						  </thead>
						  <tbody>
                          @foreach($post as $item)
						    <tr class="alert" role="alert">
                           
						      <td class="d-flex align-items-center">
                              <div class="img" style="background-image: url(/assets/uploadfile/Loaner/profile/{{$item->imageProfile}});">
                            </div>
						      	<div class="pl-3 email">
                                  <span>{{$item->firstname}} {{$item->lastname}}</span>
						      		<span></span>
						      		
						      	</div>
						      </td>
						      
                              <td  style="color: green;">
                              <div class="pl-3 email">
						      		<span>จำนวนเงินที่กู้: ฿{{$item->Principle}}</span>
						      		<span>จำนวนงวด: {{$item->instullment_total}} </span>
                                    <span>ดอกเบี้ย: {{$item->Interest}}% </span>
                                    <span> </span>
						      	</div>  
                            </td>
						      <td>
                              <div class="pl-3 email">
                              <span>วันที่เริ่ม: {{$item->date_start}} </span>
                              <span>วันที่ปิดชำระ: {{$item->Update_date}} </span>
                              <span></span>
						      	</div>  
                              </td>
                              <td>
                           
                              
    
				        	</td>
                              <td style="color: green;">สำเร็จแล้ว</td>


						      
						    </tr>
                            @endforeach
						  </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	


@endsection