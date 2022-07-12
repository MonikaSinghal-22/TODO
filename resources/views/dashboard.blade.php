@extends('layouts.site')

@section('content')

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">{{ $todays_task_count }}</div>
                        <div class="cardName">Today's Goal</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $todays_progress_count }}</div>
                        <div class="cardName">Today's Progress</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="analytics-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">{{ $completed_count }}</div>
                        <div class="cardName">Total Completed Task</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="layers-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">{{  $pending_count }}</div>
                        <div class="cardName">Total Pending Task</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="options-outline"></ion-icon>
                    </div>
                </div>


            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Today's List</h2>
                        <a href="{{ route('task.index') }}" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Status</td>
                            </tr>
                        </thead>

                        <tbody>
                            @if ($todays_task_count == 0)
                                <tr>
                                    <td></td>
                                    <td>No Task Available</td>
                                    <td></td>
                                </tr>
                            @else
                                @foreach ($todays_task as $item)
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->description}}</td>
                                    @if ($item->status == 0)
                                    <td><span class="status pending">Pending</span></td>
                                    @else
                                    <td><span class="status delivered">Completed</span></td>
                                    @endif
                                </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>


            </div>


@endsection

