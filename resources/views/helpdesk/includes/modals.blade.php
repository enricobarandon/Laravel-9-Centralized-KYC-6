<!-- declined modal -->
<div id="modal-reject" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title m-auto">DECLINE DISPOSITION</h4>
      </div>
      <div class="modal-body">
        <form action='{{ url("/helpdesk/approve/$user->id") }}' id="form_reject" method="POST">
        @csrf
            <input type="hidden" name="operation" value="disapprove" />
            <input type="hidden" name="disapprove_remarks" id="disapprove_remarks" value="">

            <div class="form-group" style="padding: 20px 60px">
            @foreach ($rejectRemarks as $key => $value)
                <div class="form-check">
                    <input class="form-check-input reject-reason" type="radio" name="reject-reason" value="{{$value}}" id="{{$key}}">
                    <label class="form-check-label radio-value" for="{{$key}}">
                        {{$value}}
                    </label>
                </div>
            @endforeach
                {{-- <div class="form-check">
                    <input class="form-check-input reject-reason" type="radio" name="reject-reason" id="reject-others1">
                    <label class="form-check-label" for="reject-others1" style="color: green">
                        <strong>Others</strong>
                    </label>
                    <textarea class="form-control" placeholder="Remarks (For Revision)" id="others1" row="2" style="resize:none; display:none;"></textarea>
                </div> --}}
                <div class="form-check">
                    <input class="form-check-input reject-reason" type="radio" name="reject-reason" id="reject-others2">
                    <label class="form-check-label" for="reject-others2" style="color: red">
                        <strong>Others</strong>
                    </label>
                    <textarea class="form-control" placeholder="Remarks (For Deactivation)" id="others2" row="2" style="resize:none; display:none;"></textarea>
                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger float-right submit-disapprove">
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>

  </div>
</div>

<!-- returned modal -->
<div id="modal-return" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title m-auto">RETURN DISPOSITION</h4>
      </div>
      <div class="modal-body">
        <form action='{{ url("/helpdesk/approve/$user->id") }}' id="form_return" method="POST">
        @csrf
            <input type="hidden" name="operation" value="return" />
            <input type="hidden" name="return_remarks" id="return_remarks" value="">

            <div class="form-group" style="padding: 20px 60px">
            @foreach ($returnRemarks as $key => $value)
                <div class="form-check">
                    <input class="form-check-input return-reason" type="radio" name="return-reason" value="{{$value}}" id="{{$key}}">
                    <label class="form-check-label radio-value" for="{{$key}}">
                        {{$value}}
                    </label>
                </div>
            @endforeach
                <div class="form-check">
                    <input class="form-check-input return-reason" type="radio" name="return-reason" id="return-others">
                    <label class="form-check-label" for="return-others" style="color: green">
                        <strong>Others</strong>
                    </label>
                    <textarea class="form-control" placeholder="Remarks" id="returnOthers" row="2" style="resize:none; display:none;"></textarea>
                </div>
            </div>

            <div class="form-group">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger float-right submit-return">
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>

  </div>
</div>
