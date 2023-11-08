@extends('layouts.instructor')

@section('content')
<div class="db__content">
  <div class="help-support-form-wrap content-wrap">
    <div class="content-box has-h2--bold">
      <h2>Help & Support</h2>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora, alias.</p>
    </div>

    <form method="POST" action="{{route('help.store')}}">
      @csrf
      <div>
        <textarea name="hsf_issue" placeholder="Write your issue here..."></textarea>
      </div>
      <div>
        <select name="hsf_subject">
          <option value="" selected disabled>Select Subject</option>
          <option value="course related">Course Related</option>
          <option value="others">Others</option>
        </select>
      </div>
      <div class="text-end">
        <button type="submit" class="btn btn--primary">Submit</button>
      </div>
    </form>
  </div>
</div>
@stop