import React, { Component } from "react";
import ReactDOM from "react-dom";
import Header from "./Shared/Components/Header/Header";
import SideBar from "./Shared/Components/SideBar/SideBar";
import { BrowserRouter } from "react-router-dom";
import {
    Route,
    Router,
    Switch,
    useLocation,
    useRouteMatch,
} from "react-router";
import HomePage from "./Shared/Components/Home";
import Department from "./Modules/Department/DepartmentDetails/Department";
import Staff from "./Modules/Staff/StaffList";
import "./App.scss";
import "./Shared/Style/btn-group.scss";
import DepartmentList from "./Modules/Department/DepartmentList/DepartmentList";
import StaffDetails from "./Modules/Staff/Components/StaffDetails/StaffDetails";
import AddMember from "./Modules/Department/Components/Members/AddMember";
import CustomerList from "./Modules/Customer/CustomerList";
import AppointmentList from "./Modules/Appointment/AppointmentList";
import CustomerDetails from "./Modules/Customer/Components/CustomerDetails/CustomerDetails";
import AppointmentDetails from "./Modules/Appointment/Components/AppointmentDetails/AppointmentDetails";
import MissionList from "./Modules/Mission/MissionList";
import MissionInfo from "./Modules/Mission/Components/MissionDetails/MissionInfo";

class App extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        
        return (
            <BrowserRouter>
                <div className="wrapper">
                    <SideBar />
                    <Header />
                    <div className="page-wrapper">
                        <div className="content-wrapper">
                            <Switch>
                                <Route exact path="/app" component={HomePage} />
                                <Route
                                    exact
                                    path="/app/departments"
                                    component={DepartmentList}
                                />
                                <Route exact path="/app/departments/:id" component={Department} />
                                <Route exact path="/app/staffs" component={Staff} />
                                <Route exact path="/app/staffs/:id" component={StaffDetails} />
                                <Route  exact path="/app/departments/:departmentId/add-member" component={AddMember}/>
                                <Route exact path="/app/customers" component={CustomerList}/>
                                <Route exact path="/app/appointments" component={AppointmentList}/>
                                <Route exact path="/app/appointments/:id" component={AppointmentDetails}/>
                                <Route exact path="/app/customers/:id" component={CustomerDetails}/>
                                <Route exact path="/app/missions" component={MissionList}/>
                                <Route exact path="/app/missions/:id" component={MissionInfo}/>
            
                            </Switch>
                            <footer className="footer mt-auto">
                                <div className="copyright bg-white">
                                    <p>
                                        © <span id="copy-year">2021</span>{" "}
                                        Copyright Company Active .
                                    </p>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>
            </BrowserRouter>
        );
    }
}

export default App;
