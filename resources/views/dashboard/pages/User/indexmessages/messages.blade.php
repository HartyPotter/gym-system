{{-- session to handle messages --}}

@if(session()->has('Created_User_Sucessfully'))
<div class="alert alert-success text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #28a745; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-check-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Created_User_Sucessfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Updated_User_Sucessfully'))
<div class="alert alert-success text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #28a745; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-check-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Updated_User_Sucessfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('error'))
<div class="alert alert-danger text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #dc3545; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-exclamation-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('error') }}
        </span>
    </h4>
</div>


@elseif(session()->has('status'))
<div class="alert alert-warning text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #ffc107; color: black; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-exclamation-triangle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('status') }}
        </span>
    </h4>
</div>



@elseif(session()->has('Deleted_User_Sucessfully'))
<div class="alert alert-danger text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #dc3545; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-exclamation-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Deleted_User_Sucessfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Created_Plan_Successfully'))
<div class="alert alert-success text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #28a745; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-check-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Created_Plan_Successfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Updated_Plan_Sucessfully'))
<div class="alert alert-success text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #28a745; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-check-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Updated_Plan_Sucessfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Deleted_Plan_Sucessfully'))
<div class="alert alert-danger text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #dc3545; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-exclamation-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Deleted_Plan_Sucessfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Created_Blog_Successfully'))
<div class="alert alert-success text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #28a745; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-check-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Created_Blog_Successfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Updated_Blog_Successfully'))
<div class="alert alert-success text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #28a745; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-check-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Updated_Blog_Successfully') }}
        </span>
    </h4>
</div>

@elseif(session()->has('Deleted_Blog_Successfully'))
<div class="alert alert-danger text-center mx-auto shadow-lg" style="max-width: 80%; margin-top: 3%; border-radius: 15px; padding: 20px; background-color: #dc3545; color: white; position: relative; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s; animation: scaleUp 1.5s infinite;">
    <h4 class="font-weight-bold">
        <i class="fas fa-exclamation-circle" style="display: inline-block; animation: bounceIcon 1.5s infinite;"></i>
        <span style="display: inline-block; animation: flashText 2s infinite;">
            {{ session()->get('Deleted_Blog_Successfully') }}
        </span>
    </h4>
</div>


@endif