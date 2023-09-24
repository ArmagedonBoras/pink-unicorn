<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menu::create(['name' => 'Info', 'link' => 'info', 'sort_order' => 10, 'gate' => 'user']);
        Menu::create(['name' => 'User', 'link' => 'anvandare', 'sort_order' => 10, 'gate' => 'hidden']);
        // Menu::create(['name' => 'Bokning', 'link' => 'bookings', 'sort_order' => 30, 'gate' => 'user']);
        // Menu::create(['name' => 'Bli medlem', 'link' => 'bli-medlem', 'sort_order' => 40, 'gate' => 'guest', 'parent' =>"medlemskap" ]);

        $membershipPage = Page::create([
            'title' => 'Om Medlemskap',
            'body' => '<p><strong>Gå med</strong><br />',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
        ]);

        $membershipMenu = Menu::create(['name' => 'Medlemskap', 'link' => 'medlemskap', 'sort_order' => 30, 'page_id' => $membershipPage->id, 'icon' => 'people']);
        $aboutMenu = Menu::create(['name' => 'Om oss', 'link' => 'om', 'sort_order' => 50, 'icon' => 'info-circle']);
        $aboutPage = Page::create([
            'title' => 'Om oss',
            'body' => '<p>Karlstads bilkooperativ har funnits sedan 1999 och är ett av Sveriges första bilkooperativ. ' .
                        'Vi är en ekonomisk förening som drivs utan vinstintresse och leds av en styrelse. Det praktiska arbetet med bilarna leds av en bilvårdsansvarig. ' .
                        'Årsmöte hålls i slutet av mars och där ser vi gärna så många medlemmar som möjligt.</p><br>' .
                        '<p>Du är välkommen att höra av dig med frågor på adressen <a href="mailto:medlemskap@karlstadsbilkooperativ.org">medlemskap@karlstadsbilkooperativ.org</a>.</p>',
            'active' => 1,
            'title_size' => 400,
            'title_image' => 'storage/bg-images/dice.jpg',
        ]);
        $aboutPage->menu()->save($aboutMenu);

        $ideaMenu = Menu::create(['name' => 'Hem', 'link' => 'hem', 'sort_order' => 10, 'icon' => 'house']);
        $ideaPage = Page::create([
            'title' => 'Välkommen!',
            'title_color' => '#ffffff',
            'tagline' => 'Kul att du hittat hit!',
            'tagline_color' => '#ffffff',
            'body' =>
                '<p>Om du är nyfiken på oss är det en bra start att läsa igenom följande.</p>

                <p>Armagedon är en ideell förening. En förening är en grupp människor som vill göra något tillsammans. Vi är anslutna till SVEROK och du kan läsa mer om dem samt ideella föreningar
                <a href="http://www.sverok.se/sverok/">här</a>!</p>

                <p>Vi har inte någon anställd som ansvarar för våra lokaler eller anordnar våra aktiviteter. Vi tar själva tillsammans hand om våra lokaler och våra speldagar/kvällar arrangeras av våra egna medlemmar.</p>


                <strong>Det innebär att vi har</strong>
                <ul>
                    <li>öppna aktiviteter som alla kan delta i men också aktiviteter för bara ett fåtal deltagare.</li>
                    <li>aktiviteter som är enkla att prova på men även sådana som kräver mer förberedelser.</li>
                    <li>gratis aktiviteter som inte kostar någonting och andra där du kan behöva köpa egna tillbehör & figurer.</li>
                </ul>

                <strong>Det betyder också att vi</strong>
                <ul>
                    <li>hjälps åt med att städa och hålla ordning.</li>
                    <li>respekterar föreningens och andra medlemmars ägodelar.</li>
                    <li>kanske inte kan erbjuda alla precis det de vill göra.</li>
                </ul>

                <strong>Vet du inte riktigt vad du vill spela/göra/testa på?</strong>
                <ul>
                    <li>Läs mer om alla slags spel som finns på SVEROKs hemsida här!</li>
                    <li>Prata med oss. Kanske har vi redan en grupp som du kan gå med i?</li>
                    <li>Prata med några vänner, prata sedan med oss - då kan vi hjälpa er komma igång!</li>
                </ul>
                Armagedons Regelbok finns tillgänglig i .pdf för nedladdning här
                <br><br>
                Välkommen till Armagedon!',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 300,
        ]);
        $ideaPage->menu()->save($ideaMenu);

        $placeMenu = Menu::create(['name' => 'Lokalen', 'link' => 'lokalen', 'sort_order' => 20, 'icon' => 'building']);
        $placeMenu = Menu::create(['name' => 'Hitta till oss!', 'link' => 'hitta', 'parent' => 'lokalen', 'sort_order' => 20, 'icon' => 'geo-alt']);
        $placePage = Page::create([
            'title' => 'Lokalen',
            'body' =>
                    '<p>Välkommen till oss! Här är vår adress:<br>
                    Armagedon<br>
                    Katrinehillsgatan 7b<br>
                    504 52 Borås<br><br>
                    <iframe width="425" height="350" src="https://www.openstreetmap.org/export/embed.html?bbox=12.946534752845766%2C57.713281970757926%2C12.951791882514955%2C57.71504130704727&amp;layer=mapnik&amp;marker=57.714161649590345%2C12.949163317680359" style="border: 1px solid black"></iframe>
                    <br/><small><a href="https://www.openstreetmap.org/?mlat=57.71416&amp;mlon=12.94916#map=19/57.71416/12.94916&amp;layers=N" target="_blank">Visa större karta</a></small>
                    <br>
                    Vi arbetar på en bättre presentation av våra lokaler. För dig som tänkt besöka oss kan det vara värt att veta att vi tyvärr inte har handikappanpassad entré. Det är trapporna en våning upp som gäller.</div>',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Stora rummet', 'link' => 'stora', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'dice-1']);
        $placePage = Page::create([
            'title' => 'Stora rummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Gröna rummet', 'link' => 'grona', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'dice-2']);
        $placePage = Page::create([
            'title' => 'Gröna rummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Blå rummet', 'link' => 'bla', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'dice-3']);
        $placePage = Page::create([
            'title' => 'Blå rummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Röda rummet', 'link' => 'roda', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'dice-4']);
        $placePage = Page::create([
            'title' => 'Röda rummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Bruna rummet', 'link' => 'bruna', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'dice-5']);
        $placePage = Page::create([
            'title' => 'Bruna rummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Målarrummet', 'link' => 'malarrummet', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'palette']);
        $placePage = Page::create([
            'title' => 'Målarrummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);
        $placeMenu = Menu::create(['name' => 'Sprayrummet', 'link' => 'sprayrummet', 'parent' => 'lokalen', 'sort_order' => 30, 'icon' => 'brush']);
        $placePage = Page::create([
            'title' => 'Sprayrummet',
            'body' => '',
            'active' => 1,
            'title_image' => 'storage/bg-images/dice.jpg',
            'title_size' => 400,
        ]);
        $placePage->menu()->save($placeMenu);

        Menu::create(['name' => 'Admin', 'link' => 'admin', 'sort_order' => 200, 'gate' => 'admin', 'icon' => 'gear']);
        Menu::create(['name' => 'Rättigheter', 'link' => 'permissions', 'sort_order' => 10, 'parent' => 'admin', 'icon' => 'shield']);
        Menu::create(['name' => 'Roller', 'link' => 'roles', 'sort_order' => 20, 'parent' => 'admin', 'icon' => 'person-vcard']);
        Menu::create(['name' => 'Taggar/listposter', 'link' => 'tags', 'sort_order' => 50, 'parent' => 'admin', 'icon' => 'list-columns']);
        Menu::create(['name' => 'Statiska sidor', 'link' => 'pages', 'sort_order' => 60, 'parent' => 'admin', 'icon' => 'file-code']);
        Menu::create(['name' => 'Medlemmar', 'link' => 'users', 'sort_order' => 70, 'parent' => 'admin', 'icon' => 'file-person']);
        Menu::create(['name' => 'Menyer', 'link' => 'menus', 'sort_order' => 90, 'parent' => 'admin', 'icon' => 'menu-button']);
        Menu::create(['name' => 'Inställningar', 'link' => 'settings', 'sort_order' => 100, 'parent' => 'admin', 'icon' => 'house-gear']);
    }
}
