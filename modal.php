<style>
  .modal-open {
    overflow: hidden !important;
  }
</style>

<!-- .....................AddGamesModal..................... -->
<div class="modal fade" id="add_games_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" id="closeModalCrossBtn" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input id="game_id" type="hidden">

        <label for="game_title" class="form-label">GameTitle</label>
        <input type="text" class="form-control mb-3 input_validate" id="game_title" name="title" placeholder="Title" required>
        <p class="text-danger" id="title_validate" style="display: none;">Title cannot be empty!</p>

        <label for="price" class="form-label">Price</label>
        <input type="number" class="form-control input_validate" id="price" name="price" placeholder="Price" min="0" style="margin-bottom: 35px;" step="any" required>
        <p class="text-danger" id="price_validate" style="display: none;">price cannot be empty!</p>

        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="radio" id="ps4" value="0" checked>
          <label class="form-check-label" for="ps4">
            PS4
          </label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="radio" id="ps5" value="1">
          <label class="form-check-label" for="ps5">
            PS5
          </label>
        </div>

        <div class="form-check" style="margin-top: 35px; margin-bottom: 35px;">
          <input class="form-check-input" type="checkbox" id="in_game_purchases" name="in_game_purchases" value="1">
          <label class="form-check-label" for="in_game_purchases">
            In-game purchases
          </label>
        </div>

        <label for="publisher" class="form-label">Publisher</label>
        <input type="text" class="form-control input_validate" id="publisher" name="publisher" placeholder="Video game company" style="margin-bottom: 35px;" required>
        <p class="text-danger" id="publisher_validate" style="display: none;">Publisher cannot be empty!</p>

        <label for="esrb" class="form-label">ESRB RATINGS</label>
        <select class="form-select" id="esrb" name="esrb_ratings" aria-label="Choose ESRB RATING" style="margin-bottom: 35px;" required>
          <option value="1">EVERYONE</option>
          <option value="2">EVERYONE 10+</option>
          <option value="3">TEEN</option>
          <option value="4">MATURE 17+</option>
        </select>

        <label for="genre" class="form-label">Genre</label>
        <select class="form-select" id="genre" name="genre" aria-label="Choose Genre" style="margin-bottom: 35px;" required>
          <option value="1">Action</option>
          <option value="2">Adventure</option>
          <option value="3">Arcade</option>
          <option value="4">Shooter</option>
          <option value="5">Role Playing Games</option>
          <option value="6">Puzzle</option>
          <option value="7">Casual</option>
          <option value="8">Simulation</option>
          <option value="9">Strategy</option>
          <option value="10">Sport</option>
          <option value="11">Driving/Racing</option>
          <option value="12">Horror</option>
          <option value="13">Fighting</option>
          <option value="14">Simulator</option>
        </select>


        <label for="online" class="form-label">Online</label>
        <select class="form-select" id="online" name="online" aria-label="Choose Online Play" style="margin-bottom: 35px;" required>
          <option value="1">Online play required</option>
          <option value="2">Online play optional</option>
          <option value="3">Offline play enabled</option>
        </select>

        <label for="players" class="form-label">Players</label>
        <input type="number" class="form-control input_validate" id="players" name="players" placeholder="Players" min="0" style="margin-bottom: 35px;" required>
        <p class="text-danger" id="players_validate" style="display: none;">Player cannot be empty!</p>

        <label for="ps_plus" class="form-label">Online player counts with PS Plus</label>
        <input type="number" class="form-control" id="ps_plus" name="online_player_counts" placeholder="Online player counts" style="margin-bottom: 35px;" min="0">

        <img src="../images/noimage.png" id="thumbnailPreview" class="w-100 d-block" alt="">
        <label for="thumbnail" class="form-label">Thumbnail(Recommended .avif,.webp,504x504)</label>
        <input class="form-control" type="file" id="thumbnail" name="thumbnail" style="margin-bottom: 35px;" accept="image/*">
        <input id="thumbnail_txt" name="thumbnail_txt" type="hidden">

        <img src="../images/noimage.png" id="posterPreview" class="w-100 d-block" alt="">
        <label for="poster" class="form-label">Poster(Recommended .avif,.webp,3840x2160)</label>
        <input class="form-control" type="file" id="poster" name="poster" style="margin-bottom: 35px;" accept="image/*">
        <input id="poster_txt" name="poster_txt" type="hidden">

        <label class="form-label" for="game_legal" style="margin-top: 35px;">Game and Legal Info</label>
        <textarea class="form-control input_validate" id="game_legal" name="legal_info" rows="10" cols="50" required></textarea>
        <p class="text-danger" id="game_legal_validate" style="display: none;">GameLegal cannot be empty!</p>

        <label class="form-label" for="footer" style="margin-top: 35px;">Footer</label>
        <textarea class="form-control input_validate" id="footer" name="footer" rows="10" cols="50" required></textarea>
        <p class="text-danger" id="footer_validate" style="display: none;">Footer cannot be empty!</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="closeModalBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="cu_btn" class="btn btn-primary" onclick="validateAndStore()">Save changes</button>
      </div>

    </div>
  </div>
</div>

<!-- .....................SearchBarModal..................... -->
<div class="modal fade" id="search-modal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <input id="search_btn" type="text" style="height: 60px;" class="form-control" placeholder="Search PS Store">

    </div>
  </div>
</div>

<script>
  //  $('#search_btn').keypress(function(event){
  //       if(event.key === "Enter"){
  //         var searchValue = $('#search_btn').val().trim();
  //         if (searchValue !== '') {
  //           window.location.href = 'searching.php?search=' + encodeURIComponent(searchValue);
  //         }
  //     }
  //     })

  $('#search_btn').keypress(function(event) {
    if (event.key === "Enter") {
      var searchValue = $('#search_btn').val().trim();
      $.ajax({
        url: "search.php",
        method: "POST",
        data: {
          searchValue
        },
        success: function(result) {
          $('#search_games').html(result);
        }
      })
    }
  })
</script>