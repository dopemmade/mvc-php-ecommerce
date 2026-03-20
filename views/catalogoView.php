<?php 
require_once 'headerView.php'; 
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<div class="container-catalog">
    <h1>🎵 Catalogo Vinili Hip Hop & Rap</h1>
    <p style="text-align:center; margin-bottom:30px;">
        Scopri tutti i nostri vinili e aggiungili al carrello!
    </p>

    <div class="prodotti">
        <?php 
        // Lista album (puoi aggiungere le copertine in assets/images/)
        $album_list = [
            ["title"=>"Enter the Wu-Tang (36 Chambers)", "artist"=>"Wu-Tang Clan", "image"=>"enter_the_wu-tang.jpg"],
            ["title"=>"Illmatic", "artist"=>"Nas", "image"=>"illmatic.jpg"],
            ["title"=>"Ready to Die", "artist"=>"The Notorious B.I.G.", "image"=>"ready_to_die.jpg"],
            ["title"=>"The Infamous", "artist"=>"Mobb Deep", "image"=>"the_infamous.jpg"],
            ["title"=>"Liquid Swords", "artist"=>"GZA", "image"=>"liquid_swords.jpg"],
            ["title"=>"Only Built 4 Cuban Linx…", "artist"=>"Raekwon", "image"=>"only_built_4_cuban_linx.jpg"],
            ["title"=>"Reasonable Doubt", "artist"=>"Jay-Z", "image"=>"reasonable_doubt.jpg"],
            ["title"=>"Midnight Marauders", "artist"=>"A Tribe Called Quest", "image"=>"midnight_marauders.jpg"],
            ["title"=>"Me Against the World", "artist"=>"2Pac", "image"=>"me_against_the_world.jpg"],
            ["title"=>"The Miseducation of Lauryn Hill", "artist"=>"Lauryn Hill", "image"=>"miseducation_of_lauryn_hill.jpg"],
            ["title"=>"Beats, Rhymes & Life", "artist"=>"A Tribe Called Quest", "image"=>"beats_rhymes_life.jpg"],
            ["title"=>"Blunted on Reality", "artist"=>"Fugees", "image"=>"blunted_on_reality.jpg"],
            ["title"=>"Madvillainy", "artist"=>"MF DOOM & Madlib", "image"=>"madvillainy.jpg"],
            ["title"=>"The College Dropout", "artist"=>"Kanye West", "image"=>"the_college_dropout.jpg"],
            ["title"=>"Damn.", "artist"=>"Kendrick Lamar", "image"=>"damn.jpg"],
            ["title"=>"Section.80", "artist"=>"Kendrick Lamar", "image"=>"section80.jpg"],
            ["title"=>"1999", "artist"=>"Joey Bada$$", "image"=>"1999.jpg"],
            ["title"=>"2000", "artist"=>"Joey Bada$$", "image"=>"2000.jpg"],
            ["title"=>"Piñata", "artist"=>"Freddie Gibbs & Madlib", "image"=>"piñata.jpg"],
            ["title"=>"Alfredo", "artist"=>"Freddie Gibbs & The Alchemist", "image"=>"alfredo.jpg"],
            ["title"=>"Pray for Paris", "artist"=>"Westside Gunn", "image"=>"pray_for_paris.jpg"],
            ["title"=>"Magic", "artist"=>"Nas", "image"=>"magic.jpg"],
            ["title"=>"King’s Disease III", "artist"=>"Nas", "image"=>"kings_disease_iii.jpg"],
            ["title"=>"The Off-Season", "artist"=>"J. Cole", "image"=>"the_off-season.jpg"],
            ["title"=>"Blue Lips", "artist"=>"ScHoolboy Q", "image"=>"blue_lips.jpg"],
            ["title"=>"DS2", "artist"=>"Future", "image"=>"ds2.jpg"],
            ["title"=>"I Never Liked You", "artist"=>"Future", "image"=>"i_never_liked_you.jpg"],
            ["title"=>"Wunna", "artist"=>"Gunna", "image"=>"wunna.jpg"],
            ["title"=>"The Last Wun", "artist"=>"Gunna", "image"=>"the_last_wun.jpg"],
            ["title"=>"Luv Is Rage", "artist"=>"Lil Uzi Vert", "image"=>"luv_is_rage.jpg"],
            ["title"=>"Eternal Atake", "artist"=>"Lil Uzi Vert", "image"=>"eternal_atake.jpg"],
            ["title"=>"Playboi Carti", "artist"=>"Playboi Carti", "image"=>"playboi_carti.jpg"],
            ["title"=>"Beerbongs & Bentleys", "artist"=>"Post Malone", "image"=>"beerbongs_bentleys.jpg"],
            ["title"=>"IGOR", "artist"=>"Tyler, The Creator", "image"=>"igor.jpg"],
            ["title"=>"Blonde", "artist"=>"Frank Ocean", "image"=>"blonde.jpg"],
            ["title"=>"Lahai", "artist"=>"Sampha", "image"=>"lahai.jpg"],
            ["title"=>"SOS", "artist"=>"SZA", "image"=>"sos.jpg"]
        ];

        foreach($album_list as $album): ?>
        <div class="prodotto-card">
            <img src="assets/images/<?php echo $album['image']; ?>" alt="<?php echo $album['title']; ?>">
            <h3><?php echo $album['title']; ?><br><small><?php echo $album['artist']; ?></small></h3>
            <form method="POST" action="aggiungi_carrello.php">
                <input type="hidden" name="album_title" value="<?php echo $album['title']; ?>">
                <input type="hidden" name="album_artist" value="<?php echo $album['artist']; ?>">
                <input type="hidden" name="album_image" value="<?php echo $album['image']; ?>">
                <button type="submit" class="btn-small">🛒 Aggiungi al carrello</button>
            </form>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once 'footerView.php'; ?>