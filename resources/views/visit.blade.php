@extends('layout')  
@section('content')
        
    <body>
      <div class="row">
    <div class="col-md-12">
      <form action="{{url('visits')}}" method="post">
        @csrf
        <h1>Fill the form for free visits</h1>
        
        <fieldset>
          
          <legend><span class="number">1</span> Your Basic Info</legend>
        
          <label for="name">Username:</label>
          <input type="text" id="name" name="user_name">
        
          <label for="phone">Phone no:</label>
          <input type="number" name="phone">
        </fieldset>
        <fieldset>           
         <label for="bio">What's your expectations for your dream home:</label>
          <textarea id="bio" name="expectations"></textarea>       
        
         <label for="job">Select Area:</label>
          <select id="job" name="area">
           
              <option value="Sector-18">Sector-18</option>
              <option value="sector-2">Sector-2</option>
              <option value="mamura">Mamura</option>
              <option value="sector-63">Sector-63</option>
              <option value="sector-66">Sector-66</option>
           
          </select>
          
          <label>Budget:</label>
          <select name="budget">
           
            <option value="20lak">20lak</option>
            <option value="30lakh">30lakh</option>
            <option value="40lakh">40lakh</option>
            <option value="50lakh">50lakh</option>
            
         
        </select>
         </fieldset>
       
        <button type="submit">Booking</button>
        
       </form>
        </div>
      </div>
      


@endsection