<!-- Person Record Modal -->
<div id="prModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Party</h4>
      </div>
      <div class="modal-body">
        <p>Add parties, for example <strong>Limited Partners</strong> or <strong>Buyer</strong>. You will be able to assign people who belong to these parties when you dispatch this contract.</p>
        {!!  Form::open(array('url' => 'party'))  !!}
            <div class="form-group">
              {!! Form::label('partyname','Party:',array('style' => 'color:black')) !!}
              <br>
              {!! Form::text('partyname', '', array('class' => 'form-control', 'placeholder' =>'eg: Limited Partners')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('party_desc','Description:', array('style' => 'color:black')) !!}
              <br>
              {!! Form::textarea('party_desc', '', array('class' => 'form-control', 'placeholder' =>'a partner in a company or venture whose liability towards its debts is legally limited to the extent of their investment.')) !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Save', array('class'=>'btn btn-success btn-sm')) !!}
              <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancel</button>
            </div>
        {!!  Form::close()  !!}
      </div>
    </div>
  </div>
</div>