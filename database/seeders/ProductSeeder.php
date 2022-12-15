<?php

namespace Database\Seeders;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Sữa tươi trân châu đường đen',
                'category_id' => 2,
                'description' => 'Sữa tươi trân châu đường đen - một cái tên quen thuộc đang gây bão phủ sóng với giới trẻ. ',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/sua-tuoi-tran-chau-duong-den.jpg',
            ],
            [
                'name' => 'Trà phô mai kem sữa',
                'category_id' => 2,
                'description' => 'Hương vị lạ miệng từ sự hòa quyện của vị phô mai đặc trưng, của lớp kem sữa béo béo ngọt ngọt.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/tra-pho-mai-kem-sua.jpg',
            ],
            [
                'name' => 'Trà hoa quả',
                'category_id' => 2,
                'description' => 'Đồ uống trà hoa quả hợp vị mà mới lạ như: trà ô long dưa vàng nam mỹ, trà thanh long bưởi đào…',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/tra-hoa-qua.jpg',
            ],
            [
                'name' => 'Matcha đá xay',
                'category_id' => 2,
                'description' => 'Matcha đá xay có vị hơi ngọt, sệt như kem và có vị chát nhẹ đặc trưng của trà xanh, dịu nhẹ và ngát hương.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/matcha-tra-xanh.jpg',
            ],
            [
                'name' => 'Trà đào chanh sả',
                'category_id' => 2,
                'description' => 'Trà đào chanh sả, như chính tên gọi của mình vậy, có vị đậm ngọt thanh của đào, có vị chua chua dịu nhẹ của chanh, có mùi thơm của sả.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/tra-dao-chanh-sa.jpg',
            ],
            [
                'name' => 'Trà hoa quả nhiệt đới',
                'category_id' => 2,
                'description' => 'Trà hoa quả nhiệt đới tại mỗi quán nước uống có thể sẽ khác nhau về các loại hoa quả.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/tra-hoa-qua-nhiet-doi.jpg',
            ],
            [
                'name' => 'Trà sữa gạo rang Hàn Quốc',
                'category_id' => 2,
                'description' => 'Trà sữa gạo rang là món nước uống rất tốt cho sức khỏe, chống oxi hóa, chống ung thư.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/tra-sua-gao-rang-han-quoc.jpg',
            ],
            [
                'name' => 'Trà sữa Hokkaido',
                'category_id' => 2,
                'description' => 'Món trà sữa Hokkaido dậy mùi caramen, ngậy vừa phải, không quá ngọt cũng không quá béo.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/TRA-SUA-HOKKAIDOU.jpg',
            ],
            [
                'name' => 'Cafe latte',
                'category_id' => 2,
                'description' => 'Không phải tự nhiên mà cafe latte lại có mặt ở hầu khắp các menu đồ uống.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/cafe-latte.jpg',
            ],
            [
                'name' => 'Cacao',
                'category_id' => 2,
                'description' => 'Cacao là một trong các loại nước uống được giới trẻ yêu thích vào mùa đông, khi thời tiết lạnh hơn.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/cacao-nong.jpg',
            ],
            [
                'name' => 'Socola đá xay',
                'category_id' => 2,
                'description' => 'Socola đáy xay vừa có vị đắng nhẹ của socola vừa có thêm vị béo của sữa, có màu nâu óng ánh đặc sánh.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/socola-da-xay.jpg',
            ],
            [
                'name' => 'Sinh tố các loại',
                'category_id' => 2,
                'description' => 'Sinh tố là món nước uống được pha chế từ các loại trái cây tươi, đá và nước ép trái cây hoặc sirô để lạnh.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/sinh-to.jpg',
            ],
            [
                'name' => 'Soda việt quất',
                'category_id' => 2,
                'description' => 'Soda việt quất tươi mát, vừa nhanh gọn vừa dễ uống luôn là lựa chọn của nhiều người.',
                'product_image' => 'https://jarvis.vn/wp-content/uploads/2019/05/soda-viet-quat.jpg',
            ],
            [
                'name' => 'Pizza Gà',
                'category_id' => 3,
                'description' => 'Pizza Gà thơm ngon giòn rụm! Mời bạn ăn nha',
                'product_image' => 'https://cdn.tgdd.vn/2020/09/CookProduct/83-1200x676.jpg',
            ],
            [
                'name' => 'Pizza Hải sản',
                'category_id' => 3,
                'description' => 'Pizza làm từ hải sản tự nhiên, ăn vào là mê ngay!',
                'product_image' => 'https://cdn.tgdd.vn/2020/09/CookProduct/1200bzhspm-1200x676.jpg',
            ],
            [
                'name' => 'Pizza Hawaii',
                'category_id' => 3,
                'description' => 'Mang hương vị của Hawaii về căn bếp nhà bạn với chiếc pizza Hawaii thơm nức mũi. ',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/2-800x450-77.jpg',
            ],
            [
                'name' => 'Pizza bắp phô mai',
                'category_id' => 3,
                'description' => 'Một chiếc pizza bắp phô mai vàng tươi, thơm ngây ngất chính là "chân ái" của các tín đồ phô mai đó.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/3-800x450-63.jpg',
            ],
            [
                'name' => 'Pizza khoai lang',
                'category_id' => 3,
                'description' => 'Sự kết hợp độc đáo của khoai lang và phô mai đã cho ra món bánh pizza khoai lang vô cùng độc đáo, mới lạ này.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/4.1-800x450-4.jpg',
            ],
            [
                'name' => 'Pizza mì tôm',
                'category_id' => 3,
                'description' => 'Một chiếc pizza "đậm chất sinh viên" đó chính là pizza mì gói.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/5-800x450-57.jpg',
            ],
            [
                'name' => 'Pizza sandwich',
                'category_id' => 3,
                'description' => 'Biến tấu chiếc bánh sandwich thường ngày của bạn thành chiếc pizza nóng hổi, thơm lừng, cực hấp dẫn thôi nào. ',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/6-800x450-45.jpg',
            ],
            [
                'name' => 'Pizza khoai tây',
                'category_id' => 3,
                'description' => 'Pizza thơm ngon mà không cần đến bột thì chỉ có có thể là pizza khoai tây.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/7-800x450-51.jpg',
            ],
            [
                'name' => 'Pizza bơ tỏi kem phô mai',
                'category_id' => 3,
                'description' => 'Phần bánh bên ngoài vàng giòn, bên trong mềm xốp. Phần kem bơ tỏi phô mai bên trên vừa thơm, vừa béo.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/9-800x450-39.jpg',
            ],
            [
                'name' => 'Pizza cuộn nhân phô mai xúc xích',
                'category_id' => 3,
                'description' => 'Lớp vỏ bánh giòn tan, ráo dầu nên không hề bị ngấy. Phần nhân xúc xích phô mai bên trong thì ngon miễn chê.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/10-800x450-32.jpg',
            ],
            [
                'name' => 'Pizza sốt pesto',
                'category_id' => 3,
                'description' => 'Một chiếc pizza sốt pesto sẽ là món ăn tuyệt vời lắp đầy cái bụng đói của bạn.',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/11-800x450-23.jpg',
            ],
            [
                'name' => 'Pizza chay',
                'category_id' => 3,
                'description' => 'Món pizza chay thơm ngon, chất lượng thượng hạng, không thua kém bất kỳ loại pizza nào ở nhà hàng, bạn đã thử chưa? ',
                'product_image' => 'https://cdn.tgdd.vn/2021/06/content/15-800x450-11.jpg',
            ],
            [
                'name' => 'Salad Trộn Dầu Giấm',
                'category_id' => 4,
                'description' => 'Rau với sốt dầu giấm',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/06/1373466/huong-dan-lam-mon-salad-dau-giam-thom-ngon-bo-duong-de-lam-tai-nha-202201081510043817.jpeg',
            ],
            [
                'name' => 'Salad Cocktail tôm',
                'category_id' => 4,
                'description' => 'Món salad Cocktail tôm sau khi hoàn thành vừa đẹp mắt lại đầy đủ dưỡng chất.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r1-800x500-1.jpg',
            ],
            [
                'name' => 'Salad mực',
                'category_id' => 4,
                'description' => 'Salad mực với cách chế biến đơn giản nhưng lại mang đến hương vị tuyệt vời và thanh mát vô cùng.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r2-800x500-1.jpg',
            ],
            [
                'name' => 'Salad sò điệp',
                'category_id' => 4,
                'description' => 'Khi ăn vào sẽ cảm nhận được mùi vị tươi ngon của sò điệp, từ từ vị cay nhè nhẹ của ớt và vị chua thanh thanh của cà chua sẽ tan trên đầu lưỡi.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r3-800x500-1.jpg',
            ],
            [
                'name' => 'Salad cá hồi',
                'category_id' => 4,
                'description' => 'Salad cá hồi được nhiều người yêu thích bởi thịt cá mềm thơm và thấm đậm gia vị.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r4-800x500-2.jpg',
            ],
            [
                'name' => 'Salad thịt bò',
                'category_id' => 4,
                'description' => 'Salad thịt bò có rau củ tươi giòn, ngọt thanh, thịt bò chín vừa mềm và ngọt vị hòa quyện cùng nước sốt chua ngọt thơm ngon, bổ dưỡng.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r6-800x500.jpg',
            ],
            [
                'name' => 'Cobb salad',
                'category_id' => 4,
                'description' => 'Cobb salad là món ăn nổi tiếng và khá phổ biến hiện nay. Cobb salad là món ăn giàu dinh dưỡng lại thơm ngon và dễ ăn.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r8-800x500.jpg',
            ],
            [
                'name' => 'Salad ức gà',
                'category_id' => 4,
                'description' => 'Ức gà vàng ươm với lớp ngoài thấm vị beo béo từ sốt mè rang, bên trong vẫn giữ được vị ngọt của thịt gà, xà lách và cà chua khiến cho màu sắc món ăn trở nên hấp dẫn.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/cl1-800x500.jpg',
            ],
            [
                'name' => 'Salad rau bina - cải bó xôi',
                'category_id' => 4,
                'description' => 'Rau bina hay còn được gọi là cải bó xôi là một loại rau nổi tiếng với nhiều lợi ích tốt cho cơ thể. Món salad rau bina với cách làm đơn giản nhưng lại vô cùng dinh dưỡng.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r9-800x500.jpg',
            ],
            [
                'name' => 'Salad cầu vồng',
                'category_id' => 4,
                'description' => 'Với hương vị nước sốt đậm đà mang đến cho bạn một món salad vừa bắt mắt, vừa thơm ngon, ăn đến đâu cũng thấy mùi vị khác lạ khó có thể ngán được.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r10-800x500.jpg',
            ],
            [
                'name' => 'Salad rong nho',
                'category_id' => 4,
                'description' => 'Món salad rong nho ngon mê ly nhìn thôi đã thấy muốn ăn thử một miếng, rong nho tươi mát, ăn đến đâu giòn tan đến đó, kết hợp với nhiều màu sắc.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r11-800x500.jpg',
            ],
            [
                'name' => 'Salad ớt chuông',
                'category_id' => 4,
                'description' => 'Ớt chuông và hành tây thơm nồng, chỉ cay nhè nhẹ kết hợp với vị ngọt tươi ngon của thịt tôm và ức gà thấm các gia vị và nước sốt salad.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r12-800x500.jpg',
            ],
            [
                'name' => 'Salad trái cây',
                'category_id' => 4,
                'description' => 'Salad trái cây không chỉ dễ ăn mà còn bổ sung lượng vitamin đáng kể cũng như các khoáng chất cần thiết khác cho cơ thể.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r14-800x500.jpg',
            ],
            [
                'name' => 'Salad hoa quả họ Berry',
                'category_id' => 4,
                'description' => 'Salad trái cây có thể kết hợp với sữa chua hoặc nước cốt chanh và mật ong, món salad này chính là tổng hòa giữa vị chua chua của dâu tây và việt quất.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r15-800x500.jpg',
            ],
            [
                'name' => 'Salad dưa lưới',
                'category_id' => 4,
                'description' => 'Với mùi thơm nức mũi, chỉ cần cắn vào là sự mọng nước từ dưa lưới sẽ tan ra trên đầu lưỡi, cùng các loại trái cây giòn ngọt và vị cay nhẹ của lá bạc hà.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r16-800x500.jpg',
            ],
            [
                'name' => 'Salad đào',
                'category_id' => 4,
                'description' => 'Salad đào với cách làm đơn giản nhưng thành phẩm cực kì đáng mong đợi. Vị chua ngọt và mùi thơm đặc trưng của đào nướng kết hợp với độ mềm, ngọt của thịt ức gà.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r17-800x500.jpg',
            ],
            [
                'name' => 'Salad quýt',
                'category_id' => 4,
                'description' => 'Quýt chua chua ngọt ngọt kết hợp với vị bùi béo của bơ vô cùng lạ miệng, các loại rau thấm nhẹ gia vị từ mật ong.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r18-800x500.jpg',
            ],
            [
                'name' => 'Salad bơ',
                'category_id' => 4,
                'description' => 'Salad bơ là sự kết hợp giữa nước sốt dứa tươi mát cùng với vị béo bùi của bơ, dứa nướng thơm lừng vẫn còn giữ được nước.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r19-800x500.jpg',
            ],
            [
                'name' => 'Salad kiwi',
                'category_id' => 4,
                'description' => 'Kiwi chua chua ngọt ngọt kết hợp với sốt mayonaise sẽ làm tăng thêm phần béo đậm đà khiến món salad trở nên độc đáo hơn.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r20-800x500.jpg',
            ],
            [
                'name' => 'Salad dưa hấu',
                'category_id' => 4,
                'description' => 'Dưa hấu chứa nhiều vitamin có lợi cho sức khỏe và giúp giải nhiệt trong những ngày hè rất tốt, thử ngay món salad dưa hấu với vị ngọt thanh.',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r21-800x500.jpg',
            ],
            [
                'name' => 'Salad Đặc Sắc',
                'category_id' => 4,
                'description' => 'Bông cải xanh, búp cải tím, táo, xà lách, trứng… và sốt Salad đặc biệt',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r8-800x500.jpg',
            ],
            [
                'name' => 'Mỳ Ý Cay Hải Sản',
                'category_id' => 5,
                'description' => 'Mỳ Ý rán với các loại hải sản tươi ngon cùng ớt và tỏi',
                'product_image' => 'https://cdn.tgdd.vn/Files/2020/05/04/1253396/cach-lam-mi-y-hai-san-don-gian-thom-ngon-dam-da-ngay-tai-nha-5.png',
            ],
            [
                'name' => 'Mỳ Ý Tôm Sốt Kem Cà Chua',
                'category_id' => 5,
                'description' => 'Sự tươi ngon của tôm kết hợp với sốt kem cà chua',
                'product_image' => 'https://cdn.tgdd.vn/2020/10/CookRecipe/Avatar/cach-lam-mi-y-tom-sot-kem-oc-cho-thumbnail.jpg',
            ],
            [
                'name' => 'Mì Ý sốt Pesto',
                'category_id' => 5,
                'description' => 'Mì Ý sốt pesto được yêu thích bởi hương vị thơm ngon. Sợi mì dai mềm được luộc đúng độ trộn cùng sốt thơm nồng của húng quế tươi, béo ngậy của phô mai.',
                'product_image' => 'https://vcdn1-giadinh.vnecdn.net/2014/03/07/MI-Y-SOT-PESTO-1-2330-1394167718.jpg?w=0&h=0&q=100&dpr=2&fit=crop&s=d4aKsRiCbBQSwwZka3LPDQ',
            ],
            [
                'name' => 'Mì Ý tôm và bí xanh',
                'category_id' => 5,
                'description' => 'Mì Ý kết hợp cùng tôm, bí xanh và rau thơm là sự lựa chọn mới lạ, giúp bạn thay thế món sốt cà chua thông thường.',
                'product_image' => 'https://media.cooky.vn/images/blog-2016/kham-pha-10-mon-mi-y-ngon-nhat-the-gioi-nhat-dinh-phai-thu-1.jpg',
            ],
            [
                'name' => 'Mì Ý sốt thịt bò băm',
                'category_id' => 5,
                'description' => 'Đây là cách làm mì Ý truyền thống đã quá quen thuộc với tất cả mọi người. Chỉ với chút thịt bò băm cùng sốt cà chua, bạn đã có món mỳ thơm ngon tuyệt hảo.',
                'product_image' => 'https://media.cooky.vn/images/blog-2016/kham-pha-10-mon-mi-y-ngon-nhat-the-gioi-nhat-dinh-phai-thu-3.jpg',
            ],
            [
                'name' => 'Mì Ý sốt súp lơ và rượu vang đỏ',
                'category_id' => 5,
                'description' => 'Thay vì sử dụng những nguyên liệu truyền thống, bạn hoàn toàn có thể biến tấu món mì Ý trở nên thơm ngon, lạ miệng hơn với súp lơ, rượu vang đỏ và phô mai.',
                'product_image' => 'https://media.cooky.vn/images/blog-2016/kham-pha-10-mon-mi-y-ngon-nhat-the-gioi-nhat-dinh-phai-thu-5.jpg',
            ],
            [
                'name' => 'Mì Ý sốt thịt gà cay',
                'category_id' => 5,
                'description' => 'SMón mì sốt teriyaki, thịt gà xé phay, cà chua, ớt, hành tây, thích hợp cho những người thích ăn cay. Món ăn này phổ biến tại Nhật Bản.',
                'product_image' => 'https://media.cooky.vn/images/blog-2016/kham-pha-10-mon-mi-y-ngon-nhat-the-gioi-nhat-dinh-phai-thu-6.jpg',
            ],
            [
                'name' => 'Chè đậu đỏ',
                'category_id' => 6,
                'description' => 'Đậu ngọt bùi, nước cốt dừa béo béo vừa ăn, sẽ là món tráng miệng phù hợp cho những buổi cơm chiều cuối tuần oi ả.',
                'product_image' => 'https://statics.vinpearl.com/che-dau-do-0_1631353601.png',
            ],
            [
                'name' => 'Chè vải hạt sen',
                'category_id' => 6,
                'description' => 'Chè vải hạt sen có tác dụng thanh nhiệt cơ thể. Hạt sen giòn giòn, bùi bùi, vải ngọt thanh, thơm ngon.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201445168873.jpg',
            ],
            [
                'name' => 'Bánh chuối nướng',
                'category_id' => 6,
                'description' => 'Bánh chuối nướng là món bánh tráng miệng thơm ngon, nguyên liệu dễ. Món bánh tơi xốp có vị ngọt vừa phải của chuối, mùi thơm nồng nàn, rất kích thích vị giác.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201445333508.jpg',
            ],
            [
                'name' => 'Bánh da lợn',
                'category_id' => 6,
                'description' => 'Bánh da lợn là món bánh dân dã của vùng quê Nam Bộ, Việt Nam. Bánh thơm mát mùi lá dứa, ngọt bùi hương vị đậu xanh. Bánh mềm, mịn và dẻo vừa ăn.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201445506320.jpg',
            ],
            [
                'name' => 'Sương sáo nước cốt dừa',
                'category_id' => 6,
                'description' => 'Sương sáo nước cốt dừa là món tráng miệng thích hợp cho những buổi chiều nóng nực.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201446036682.jpg',
            ],
            [
                'name' => 'Chè dừa dầm',
                'category_id' => 6,
                'description' => 'Chè có vị ngọt thanh, béo béo của sữa dừa, phần cùi dừa dai mềm vừa phải.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201446192185.jpg',
            ],
            [
                'name' => 'Bánh chuối hấp nước cốt dừa',
                'category_id' => 6,
                'description' => 'Bánh chuối mềm, dẻo và ngọt vừa ăn, ăn kèm nước cốt dừa thơm, béo.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201446325834.jpg',
            ],
            [
                'name' => 'Chè 3 màu',
                'category_id' => 6,
                'description' => 'Chè 3 màu là sự kết hợp hài hòa của ba loại đậu (đỏ, trắng, xanh), thạch lá dứa và nước cốt dừa.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201446466089.jpg',
            ],
            [
                'name' => 'Chè nhãn nhục',
                'category_id' => 6,
                'description' => 'Chè nhãn nhục thường được nấu với đường phèn nên ngọt thanh. Nhãn nhục ngọt, mọng nước, bạn có thể thêm vào hạt sen.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201447056338.jpg',
            ],
            [
                'name' => 'Chè khúc bạch',
                'category_id' => 6,
                'description' => 'Chè khúc bạch là sự kết hợp hài hòa của nước đường phèn ngọt thanh, thơm thoang thoảng mùi vải, ăn kèm với những viên khúc bạch thơm.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201447315646.jpg',
            ],
            [
                'name' => 'Chè trái cây',
                'category_id' => 6,
                'description' => 'Chè trái cây là sự kết hợp tuyệt vời của nhiều loại trái cây với nhau, ăn cùng nước đường phèn ngọt thanh.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201447471034.jpg',
            ],
            [
                'name' => 'Kem chuối',
                'category_id' => 6,
                'description' => 'Kem chuối mát lạnh sẽ là món tráng miệng ngon sau bữa ăn. Kem chuối có vị ngọt từ chuối, vị béo từ nước cốt dừa, vị bùi của đậu phộng và dừa bào.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201448021185.jpg',
            ],
            [
                'name' => 'Chè bánh lọt nước cốt dừa',
                'category_id' => 6,
                'description' => 'Bánh lọt nước cốt dừa là món tráng miệng thơm ngon, nổi tiếng tại vùng đất Nam Bộ. Bánh lọt được trộn chung với lá dứa để tạo ra màu xanh bắt mắt, bánh thơm mùi lá dứa.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201448180374.jpg',
            ],
            [
                'name' => 'Bánh đậu xanh trái cây',
                'category_id' => 6,
                'description' => 'Bánh đậu xanh trái cây là món tráng vừa đẹp mắt, vừa thơm ngon. Bánh có vị béo bùi, ngọt dịu vừa ăn, được tạo thành những loại hình trái cây và rau củ bắt mắt, thú vị.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201448317984.jpg',
            ],
            [
                'name' => 'Rau câu dừa',
                'category_id' => 6,
                'description' => 'Rau câu dừa là món tráng miệng phổ biến tại Việt Nam. Đây là món tráng miệng dịu mát, thích hợp dùng sau bữa cơm gia đình. Rau câu dừa có vị ngọt thanh của nước dừa tươi và vị béo nhẹ từ nước cốt dừa.',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/20/1376549/top-15-mon-trang-mieng-viet-nam-ngon-nhat-ma-ban-nen-biet-202108201448528939.jpg',
            ],
            [
                'name' => 'Gà chiên mắm tỏi',
                'category_id' => 7,
                'description' => 'Gà chiên mắm tỏi siêu ngon.',
                'product_image' => 'https://dienmaynewsun.com/wp-content/uploads/2019/08/143-cac-mon-ga-chien.jpg',
            ],
            [
                'name' => 'Gà rang muối',
                'category_id' => 7,
                'description' => 'Gà rang muối đậm đà hương vị.',
                'product_image' => 'https://dienmaynewsun.com/wp-content/uploads/2019/08/140-cac-mon-ga-chien.jpg',
            ],
            [
                'name' => 'Gà chiên sữa',
                'category_id' => 7,
                'description' => 'Gà chiên sữa mới lạ.',
                'product_image' => 'https://dienmaynewsun.com/wp-content/uploads/2019/08/114-cac-mon-ga-chien.jpg',
            ],
            [
                'name' => 'Gà chiên sốt tỏi mật ong',
                'category_id' => 7,
                'description' => 'Gà chiên sốt tỏi mật ong cách chế biến độc đáo.',
                'product_image' => 'https://dienmaynewsun.com/wp-content/uploads/2019/08/141-cac-mon-ga-chien.jpg',
            ],
            [
                'name' => 'Cánh gà chiên sốt coca',
                'category_id' => 7,
                'description' => 'Cánh gà chiên sốt coca vị ngon mới.',
                'product_image' => 'https://dienmaynewsun.com/wp-content/uploads/2019/08/113-cac-mon-ga-chien.jpg',
            ],
        ]);
    }
}
