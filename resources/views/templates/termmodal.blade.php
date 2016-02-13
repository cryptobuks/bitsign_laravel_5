<!-- Add Term Modal -->
<div id="termModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Term</h4>
      </div>
      <div class="modal-body">
        <p>Add term, for example <strong>The Company</strong> or <strong>The Shipment</strong>. Separate mutliple words meaning the same thing with commas, for example <strong>You, Your</strong></p><p>After adding, you will be able to drag and drop this term anywhere in your contract, and even inside another term.</p>
        {!!  Form::open(array('url' => 'term'))  !!}
            <div class="form-group">
              {!! Form::label('termname','Party:',array('style' => 'color:black')) !!}
              <br>
              {!! Form::text('termname', '', array('class' => 'form-control', 'placeholder' =>'eg: You, Your')) !!}
            </div>
            <div class="form-group">
              {!! Form::label('term_desc','Description:', array('style' => 'color:black')) !!}
              <br>
              {!! Form::textarea('term_desc', '', array('class' => 'form-control', 'placeholder' =>'an individual or entity exercising rights under this Licence')) !!}
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