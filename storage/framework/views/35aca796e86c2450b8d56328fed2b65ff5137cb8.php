<?php if(!empty($meeting) and !empty($meeting->meetingTimes) and $meeting->meetingTimes->count() > 0): ?>
    <?php $__env->startPush('styles_top'); ?>
        <link rel="stylesheet" href="/assets/vendors/wrunner-html-range-slider-with-2-handles/css/wrunner-default-theme.css">
    <?php $__env->stopPush(); ?>

    <div class="mt-40">
        <h3 class="font-16 font-weight-bold text-dark-blue"><?php echo e(trans('site.view_available_times')); ?></h3>

        <div class="mt-35">
            <div class="row align-items-center justify-content-center">
                <input type="hidden" id="inlineCalender" class="form-control">
                <div class="inline-reservation-calender"></div>
            </div>
        </div>
    </div>
    <?php
        $instructorEmail = $user->email;
        $instructorName = $user->full_name;
        
    ?>
    <div class="pick-a-time d-none" id="PickTimeContainer" data-user-id="<?php echo e($user['id']); ?>">

        <?php if(
            !empty(getFeaturesSettings('frontend_coupons_display_type')) and
                !empty($instructorDiscounts) and
                count($instructorDiscounts)): ?>
            <?php $__currentLoopData = $instructorDiscounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instructorDiscount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web.default.includes.discounts.instructor_discounts_card', [
                    'discount' => $instructorDiscount,
                    'instructorDiscountClassName' => 'my-40',
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <div class="d-flex align-items-center my-40 rounded-lg border px-10 py-5">
            <div class="appointment-timezone-icon">
                <img src="/assets/default/img/icons/timezone.svg" alt="appointment timezone">
            </div>
            <div class="ml-15">
                <div class="font-16 font-weight-bold text-dark-blue"><?php echo e(trans('update.note')); ?>:</div>
                <p class="font-14 font-weight-500 text-gray">
                    <?php echo e(trans('update.appointment_timezone_note_hint', ['timezone' => $meetingTimezone . ' ' . toGmtOffset($meetingTimezone)])); ?>

                </p>
            </div>
        </div>


        
        <?php echo $__env->make('web.default.includes.cashback_alert', [
            'itemPrice' => $meeting->amount,
            'classNames' => 'mt-0 mb-40',
            'itemType' => 'meeting',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <div class="loading-img d-none text-center">
            <img src="/assets/default/img/loading.gif" width="80" height="80">
        </div>

        <form action="<?php echo e(!$meeting->disabled ? '/meetings/reserve' : ''); ?>" method="post" id="PickTimeBody"
            class="d-none">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
            <input type="hidden" name="day" id="selectedDay" value="">

            <h3 class="font-16 font-weight-bold text-dark-blue">
                <?php if($meeting->disabled): ?>
                    <?php echo e(trans('public.unavailable')); ?>

                <?php else: ?>
                    <?php echo e(trans('site.pick_a_time')); ?>

                    <?php if(!empty($meeting) and !empty($meeting->discount) and !empty($meeting->amount) and $meeting->amount > 0): ?>
                        <span class="badge badge-danger text-white font-12"><?php echo e($meeting->discount); ?>%
                            <?php echo e(trans('public.off')); ?></span>
                    <?php endif; ?>
                <?php endif; ?>
            </h3>

            

            <?php if(!$meeting->disabled): ?>
                <div id="availableTimes" class="d-flex flex-wrap align-items-center mt-25">

                </div>

                <div class="js-time-description-card d-none mt-25 rounded-sm border p-10">

                </div>

                <div class="mt-25 d-none js-finalize-reserve">
                    <h3 class="font-16 font-weight-bold text-dark-blue"><?php echo e(trans('update.finalize_your_meeting')); ?></h3>
                    

                    <div class="mt-15">
                        

                        <div class="d-flex align-items-center mt-5">
                            

                            <div class="meeting-type-reserve position-relative">
                                <input type="hidden" name="instructor_email" value="<?php echo e($instructorEmail); ?>"/>
                                <input type="hidden" name="instructor_name" value="<?php echo e($instructorName); ?>"/>
                                <input type="radio" name="meeting_type" id="meetingTypeOnline" value="online">
                                <label for="meetingTypeOnline"><?php echo e(trans('update.online')); ?></label>
                            </div>
                        </div>
                    </div>

                    
                </div>

                <div class="js-reserve-description d-none form-group mt-30">
                    <label class="input-label"><?php echo e(trans('public.description')); ?></label>
                    <textarea name="description" class="form-control" rows="5"
                        placeholder="<?php echo e(trans('update.reserve_time_description_placeholder')); ?>"></textarea>
                </div>

                <div class="js-reserve-btn d-none align-items-center justify-content-end mt-30">
                    <button type="button"
                        class="js-submit-form btn btn-primary"><?php echo e(trans('meeting.reserve_appointment')); ?></button>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <?php $__env->startPush('scripts_bottom'); ?>
        <script src="/assets/vendors/wrunner-html-range-slider-with-2-handles/js/wrunner-jquery.js"></script>
    <?php $__env->stopPush(); ?>
<?php else: ?>
    <?php echo $__env->make(getTemplate() . '.includes.no-result', [
        'file_name' => 'meet.png',
        'title' => trans('site.instructor_not_available'),
        'hint' => '',
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php endif; ?>
<?php /**PATH /home/u547430766/domains/lms-code-s-academy.com/public_html/resources/views/web/default/user/profile_tabs/appointments.blade.php ENDPATH**/ ?>