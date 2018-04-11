<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend style="text-align: center;"><h1>  GameMania Product Search </h1></legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="product">Product :</label>  
            <div class="col-md-4">
                <input id="product" name="product" type="text" placeholder="Input Text" class="form-control input-md">
            </div>
        </div>

        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="platform">Platform:</label>
          <div class="col-md-4">
            <select id="platform" name="platform" class="form-control">
              <option value="">Select One</option>
              <?=displayPlatforms()?>
            </select>
          </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
          <label class="col-md-4 control-label" for="priceFrom">Price: From:</label>  
          <div class="col-md-2">
              <input id="priceFrom" name="priceFrom" type="text" placeholder="" class="form-control input-md">
          </div>
          <label class="col-md-1 control-label" for="priceTo">To:</label>  
          <div class="col-md-2">
          <input id="priceTo" name="priceTo" type="text" placeholder="" class="form-control input-md">
            
          </div>
        </div>

        <!-- Multiple Radios -->
        <div class="form-group">
          <label class="col-md-5 control-label" for="orderBy">Order Results By:</label>
          <div class="col-md-4">
          <div class="radio">
            <label for="orderBy-0">
              <input type="radio" name="orderBy" id="orderBy-0" value="name" checked="checked">
              Product Name
            </label>
        	</div>
          <div class="radio">
            <label for="orderBy-1">
              <input type="radio" name="orderBy" id="orderBy-1" value="priceD">
              Price (<span class="glyphicon glyphicon-arrow-up"></span>)
            </label>
        	</div>
        	<div class="radio">
            <label for="orderBy-2">
              <input type="radio" name="orderBy" id="orderBy-2" value="priceA">
              Price (<span class="glyphicon glyphicon-arrow-down"></span>)
            </label>
        	</div>
          </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Search" class="col-md-12 btn btn-success" name="searchForm" />
        </div>
    </fieldset>
</form>
<br />
<hr>