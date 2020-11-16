<?php

namespace Database\Seeders;

use App\Models\Job_category;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job = ['An Ninh / Bảo Vệ','An Toàn Lao Động','Bán hàng','Bán lẻ / Bán sỉ','Báo chí / Biên tập viên / Xuất bản',
            'Bảo hiểm','Bảo trì / Sửa chữa','Bất động sản','Biên phiên dịch / Thông dịch viên',
            'Biên phiên dịch (tiếng Nhật)','Chăm sóc sức khỏe / Y tế','CNTT - Phần cứng / Mạng',
            'CNTT - Phần mềm','Dầu khí / Khoáng sản','Dệt may / Da giày','Dịch vụ khách hàng',
            'Điện lạnh / Nhiệt lạnh','Du lịch','Dược / Sinh học','Điện / Điện tử','Đồ Gỗ',
            'Giáo dục / Đào tạo / Thư viện','Hàng gia dụng','Hóa chất / Sinh hóa / Thực phẩm',
            'Kế toán / Kiểm toán','Khách sạn','Kiến trúc','Kỹ thuật ứng dụng / Cơ khí','Lao động phổ thông',
            'Môi trường / Xử lý chất thải','Mới tốt nghiệp / Thực tập','Ngân hàng / Chứng khoán',
            'Nghệ thuật / Thiết kế / Giải trí','Người nước ngoài','Nhà hàng / Dịch vụ ăn uống','Nhân sự',
            'Nội thất / Ngoại thất','Nông nghiệp / Lâm nghiệp','Ô tô','Pháp lý / Luật','Phi chính phủ / Phi lợi nhuận',
            'Quản lý chất lượng (QA / QC)','Quản lý điều hành','Quảng cáo / Khuyến mãi / Đối ngoại',
            'Sản xuất / Vận hành sản xuất','Tài chính / Đầu tư','Thời trang','Thuỷ Hải Sản','Thư ký / Hành chánh',
            'Tiếp thị','Tư vấn','Vận chuyển / Giao thông / Kho bãi','Vật tư / Mua hàng','Viễn Thông','Xây dựng',
            'Xuất nhập khẩu / Ngoại thương','Khác'];
        foreach($job as $j)
        {
            Job_category::create(array('job_name' => $j));
        }
    }
}
