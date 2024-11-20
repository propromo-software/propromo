import Foundation
import SwiftUI

struct ChooseProviderView: View {
    @State private var selectedProvider = 1

    var body: some View {
        VStack(alignment: .center) {
            HStack {
                StepIndicator(currentStep: 2, dotCount: 3)
                    .padding(.leading, 35)
                    .padding(.top, 35)

                Spacer()
            }

            Form {
                Section {
                    Picker("Select a provider", selection: $selectedProvider) {
                        Text("Github").tag(1)
                        Text("Jira").tag(2)
                    }
                    .pickerStyle(SegmentedPickerStyle())
                }
            }
            .formStyle(.columns)
            .navigationBarTitleDisplayMode(.large)
            .navigationTitle("Choose Provider")
            .listSectionSpacing(0)
            .scrollContentBackground(.hidden)
            .padding(.horizontal, 35)
            .padding(.vertical, 15)

            Rectangle()
                .fill(Color.gray)
                .frame(height: 150)
                .padding(.horizontal, 35)

            HStack {
                Spacer()

                NavigationLink(destination: CreateMonitorView()) {
                    Text("Choose")
                }.buttonStyle(.borderedProminent)
            }.padding(.horizontal, 35)

            Spacer()
        }
    }
}

struct ChooseProviderView_Previews: PreviewProvider {
    static var previews: some View {
        ChooseProviderView()
    }
}
