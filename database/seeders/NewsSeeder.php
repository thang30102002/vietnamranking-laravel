<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user (assuming there's an admin user)
        $admin = User::whereHas('user_role', function($query) {
            $query->where('role_id', 1); // Admin role
        })->first();

        if (!$admin) {
            // If no admin user, create one or use first user
            $admin = User::first();
        }

        if (!$admin) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }


        $newsData = [
            [
                'title' => 'Giải đấu Billiard Việt Nam 2024: Những điểm nổi bật',
                'content' => 'Giải đấu Billiard Việt Nam 2024 đã kết thúc với nhiều kỷ lục mới được thiết lập. Giải đấu năm nay thu hút hơn 200 cơ thủ từ khắp cả nước tham gia, tạo nên một sân chơi cạnh tranh và hấp dẫn.

Các cơ thủ đã thể hiện trình độ kỹ thuật cao với những pha đánh đẹp mắt và chính xác. Đặc biệt, giải đấu năm nay có sự tham gia của nhiều cơ thủ trẻ tuổi, cho thấy sự phát triển mạnh mẽ của bộ môn billiard tại Việt Nam.

Giải đấu không chỉ là nơi tranh tài mà còn là cơ hội để các cơ thủ giao lưu, học hỏi kinh nghiệm từ nhau. Điều này góp phần nâng cao trình độ chung của cộng đồng billiard Việt Nam.',
                'excerpt' => 'Giải đấu Billiard Việt Nam 2024 đã kết thúc với nhiều kỷ lục mới được thiết lập, thu hút hơn 200 cơ thủ tham gia.',
                'status' => 'published',
                'views' => 1250
            ],
            [
                'title' => 'Kỹ thuật đánh billiard cơ bản cho người mới bắt đầu',
                'content' => 'Billiard là một môn thể thao đòi hỏi sự chính xác và kiên nhẫn. Đối với những người mới bắt đầu, việc nắm vững các kỹ thuật cơ bản là rất quan trọng.

1. Tư thế đứng: Đứng chắc chắn, chân rộng bằng vai, trọng tâm dồn về chân trước.

2. Cách cầm cơ: Cầm cơ một cách thoải mái, không quá chặt tay. Ngón tay cái và ngón trỏ tạo thành vòng tròn quanh cơ.

3. Điểm ngắm: Xác định điểm tiếp xúc giữa cơ và bi, điểm đích cần đánh.

4. Động tác đánh: Đánh cơ một cách mượt mà, không giật cục. Tập trung vào điểm ngắm và thực hiện động tác đánh.

Việc luyện tập thường xuyên sẽ giúp bạn cải thiện kỹ thuật và trở thành một cơ thủ giỏi.',
                'excerpt' => 'Hướng dẫn chi tiết các kỹ thuật cơ bản trong billiard dành cho người mới bắt đầu.',
                'status' => 'published',
                'views' => 890
            ],
            [
                'title' => 'Cơ thủ Nguyễn Văn A giành chức vô địch giải đấu quốc tế',
                'content' => 'Cơ thủ Nguyễn Văn A đã xuất sắc giành chức vô địch tại giải đấu billiard quốc tế tổ chức tại Bangkok, Thái Lan. Đây là lần đầu tiên một cơ thủ Việt Nam giành được danh hiệu cao quý này.

Trong trận chung kết, Nguyễn Văn A đã thể hiện sự bình tĩnh và kỹ thuật điêu luyện khi đánh bại đối thủ đến từ Philippines với tỷ số 9-7. Trận đấu kéo dài hơn 3 giờ đồng hồ với nhiều pha đánh đẹp mắt.

"Tôi rất vui mừng khi mang về danh hiệu này cho Việt Nam. Đây là kết quả của quá trình luyện tập miệt mài và sự hỗ trợ từ gia đình, bạn bè", Nguyễn Văn A chia sẻ sau trận đấu.

Thành tích này đã đưa Nguyễn Văn A lên vị trí thứ 15 trong bảng xếp hạng thế giới, đánh dấu một bước tiến quan trọng của billiard Việt Nam trên đấu trường quốc tế.',
                'excerpt' => 'Cơ thủ Nguyễn Văn A đã xuất sắc giành chức vô địch tại giải đấu billiard quốc tế tại Bangkok.',
                'status' => 'published',
                'views' => 2100
            ],
            [
                'title' => 'Sự kiện giao lưu billiard giữa các câu lạc bộ',
                'content' => 'Sự kiện giao lưu billiard giữa các câu lạc bộ trong thành phố đã được tổ chức thành công tại Trung tâm Thể thao thành phố. Sự kiện thu hút hơn 100 cơ thủ từ 15 câu lạc bộ khác nhau tham gia.

Chương trình bao gồm các hoạt động như thi đấu giao hữu, trao đổi kinh nghiệm, và các trò chơi vui nhộn. Đây là cơ hội tốt để các cơ thủ gặp gỡ, kết bạn và học hỏi lẫn nhau.

Ban tổ chức đã chuẩn bị nhiều phần quà hấp dẫn cho các cơ thủ tham gia. Ngoài ra, còn có các hoạt động phụ như triển lãm dụng cụ billiard và hướng dẫn kỹ thuật cho người mới bắt đầu.

Sự kiện đã góp phần thúc đẩy phong trào billiard trong thành phố và tạo ra một cộng đồng gắn kết hơn.',
                'excerpt' => 'Sự kiện giao lưu billiard giữa các câu lạc bộ đã được tổ chức thành công với sự tham gia của hơn 100 cơ thủ.',
                'status' => 'published',
                'views' => 650
            ],
            [
                'title' => 'Hướng dẫn chọn cơ billiard phù hợp',
                'content' => 'Việc chọn cơ billiard phù hợp là một yếu tố quan trọng quyết định đến hiệu suất thi đấu của bạn. Dưới đây là một số gợi ý để chọn cơ phù hợp:

1. Chất liệu cơ: Cơ gỗ tự nhiên thường có độ bền và cảm giác tốt hơn cơ nhân tạo. Gỗ maple và gỗ ash là những lựa chọn phổ biến.

2. Trọng lượng: Cơ nặng thường ổn định hơn nhưng khó điều khiển. Cơ nhẹ dễ điều khiển nhưng có thể thiếu ổn định. Trọng lượng lý tưởng thường từ 18-21 ounce.

3. Độ dài: Cơ tiêu chuẩn có độ dài 57-58 inch. Người cao có thể chọn cơ dài hơn, người thấp nên chọn cơ ngắn hơn.

4. Đầu cơ: Đầu cơ cứng phù hợp với người mới bắt đầu, đầu cơ mềm phù hợp với người có kinh nghiệm.

5. Ngân sách: Cơ giá rẻ có thể phù hợp với người mới bắt đầu, nhưng cơ đắt tiền thường có chất lượng tốt hơn và bền hơn.',
                'excerpt' => 'Hướng dẫn chi tiết cách chọn cơ billiard phù hợp với trình độ và nhu cầu của từng người.',
                'status' => 'published',
                'views' => 1200
            ]
        ];

        foreach ($newsData as $data) {
            News::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'excerpt' => $data['excerpt'],
                'status' => $data['status'],
                'author_id' => $admin->id,
                'views' => $data['views'],
                'image' => null, // No image for now
                'slug' => \Illuminate\Support\Str::slug($data['title'])
            ]);
        }

        $this->command->info('News seeded successfully!');
    }
}