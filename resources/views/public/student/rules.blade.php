@extends('layouts.public')

@section('title', 'Rules & Regulations')

@section('content')
<div class="pt-32 pb-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Student Rules & Regulations</h1>
            <div class="h-1 w-20 bg-gradient-to-r from-maroon-600 to-yellow-400 rounded"></div>
        </div>

        <!-- Introduction -->
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded mb-12">
            <p class="text-gray-700 leading-relaxed">
                The following rules and regulations are established to maintain an orderly, safe, and conducive learning environment. 
                All students are expected to uphold these standards and contribute to the positive culture of the College.
            </p>
        </div>

        <!-- Rules Sections -->
        <div class="space-y-6">
            <!-- Academic Integrity -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Academic Integrity</h2>
                </div>
                <div class="p-6 space-y-3 text-gray-700">
                    <p><strong>1.1 Plagiarism & Cheating</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>All assignments and exams must be original work</li>
                        <li>Proper citation and referencing must be used for all sources</li>
                        <li>Cheating in examinations will result in failure and disciplinary action</li>
                        <li>Collaboration is permitted only when explicitly authorized by the instructor</li>
                    </ul>
                    <p className="mt-4"><strong>1.2 Academic Misconduct Penalties</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>First offense: Warning and possible zero grade on assignment</li>
                        <li>Second offense: Suspension from course</li>
                        <li>Third offense: Dismissal from the College</li>
                    </ul>
                </div>
            </div>

            <!-- Attendance & Tardiness -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Attendance & Tardiness</h2>
                </div>
                <div class="p-6 space-y-3 text-gray-700">
                    <p><strong>2.1 Attendance Policy</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Minimum 85% attendance is required to be eligible for final examination</li>
                        <li>Absences must be reported to the instructor within 24 hours</li>
                        <li>Medical certificates are required for health-related absences exceeding 2 days</li>
                    </ul>
                    <p className="mt-4"><strong>2.2 Tardiness</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Students arriving more than 15 minutes late will not be admitted to class</li>
                        <li>Repeated tardiness may result in disciplinary action</li>
                    </ul>
                </div>
            </div>

            <!-- Classroom Conduct -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Classroom Conduct</h2>
                </div>
                <div class="p-6 space-y-3 text-gray-700">
                    <p><strong>3.1 Expected Behavior</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Maintain respectful and professional communication with instructors and peers</li>
                        <li>Refrain from disruptive behavior during class</li>
                        <li>Use of mobile phones and electronic devices is not permitted during lectures</li>
                        <li>Food and beverages are not allowed in classrooms</li>
                    </ul>
                    <p className="mt-4"><strong>3.2 Disciplinary Measures</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>First offense: Verbal warning from instructor</li>
                        <li>Second offense: Written warning from department</li>
                        <li>Subsequent offenses: Referral to Student Affairs for disciplinary review</li>
                    </ul>
                </div>
            </div>

            <!-- Dress Code -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Dress Code</h2>
                </div>
                <div class="p-6 space-y-3 text-gray-700">
                    <p><strong>4.1 General Dress Code</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Appropriate, clean, and well-maintained attire is required</li>
                        <li>Clothing that is transparent, revealing, or offensive is prohibited</li>
                        <li>Appropriate footwear must be worn at all times</li>
                    </ul>
                    <p className="mt-4"><strong>4.2 Laboratory/Practical Classes</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Engineering lab coats are mandatory in laboratories</li>
                        <li>Closed-toe shoes are required</li>
                        <li>Long hair must be tied back in laboratories</li>
                        <li>Jewelry and loose clothing that may cause hazards are prohibited</li>
                    </ul>
                </div>
            </div>

            <!-- Safety & Campus Conduct -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Safety & Campus Conduct</h2>
                </div>
                <div class="p-6 space-y-3 text-gray-700">
                    <p><strong>5.1 Campus Safety</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>All safety protocols and emergency procedures must be followed</li>
                        <li>Violence, threats, or harassment of any kind is strictly prohibited</li>
                        <li>Illegal substances and alcohol are prohibited on campus</li>
                        <li>Smoking is only permitted in designated areas</li>
                    </ul>
                    <p className="mt-4"><strong>5.2 Equipment & Property</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Students are responsible for college equipment issued to them</li>
                        <li>Damage to property may result in cost reimbursement</li>
                        <li>Theft of college property is a serious offense</li>
                    </ul>
                </div>
            </div>

            <!-- Grading & Assessment -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-maroon-600 to-maroon-700 px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">Grading & Assessment</h2>
                </div>
                <div class="p-6 space-y-3 text-gray-700">
                    <p><strong>6.1 Grade Appeal Process</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Students may appeal grades within 5 days of receiving their final grade</li>
                        <li>Grades are based on course requirements and standards established by the instructor</li>
                        <li>Grade appeals must be submitted in writing with supporting evidence</li>
                    </ul>
                    <p className="mt-4"><strong>6.2 Make-up Examinations</strong></p>
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Make-up exams are permitted for legitimate, documented reasons only</li>
                        <li>Requests must be submitted within 24 hours of the missed exam</li>
                        <li>Medical certification may be required for health-related absences</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Student Rights -->
        <div class="mt-12 bg-yellow-50 rounded-lg p-8 border-l-4 border-yellow-400">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Student Rights</h2>
            <ul class="space-y-3 text-gray-700">
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Right to fair treatment and due process in all college procedures</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Right to access academic records and transcripts</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Right to safe and secure learning environment</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Right to accessibility accommodations for students with disabilities</span>
                </li>
                <li class="flex items-start">
                    <span class="inline-block w-2 h-2 bg-maroon-600 rounded-full mt-2 mr-4 flex-shrink-0"></span>
                    <span>Right to privacy of personal information</span>
                </li>
            </ul>
        </div>

        <!-- Contact Information -->
        <div class="mt-12 bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Need Clarification?</h2>
            <p class="text-gray-700 mb-4">
                For questions or concerns regarding student rules and regulations, please contact:
            </p>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="text-gray-700"><strong>Office of Student Affairs</strong></p>
                <p class="text-gray-700">Location: Student Services Building, Ground Floor</p>
                <p class="text-gray-700">Email: studentaffairs@uphsl.edu.ph</p>
                <p class="text-gray-700">Phone: (02) 1234-5678</p>
                <p class="text-gray-700">Office Hours: Monday - Friday, 8:00 AM - 5:00 PM</p>
            </div>
        </div>
    </div>
</div>
@endsection
